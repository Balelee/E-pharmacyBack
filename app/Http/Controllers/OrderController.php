<?php

namespace App\Http\Controllers;

use App\Events\ProduitDemande;
use App\Http\Resources\OrderResource;
use App\Http\Resources\OrderStatusStatResource;
use App\Jobs\BroadcastToPharmaciesJob;
use App\Models\Enums\OrderStatus;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Pharmacy;
use Illuminate\Http\Request;

class OrderController extends BaseController
{

    public function stats()
{
    $counts = Order::select('status')
        ->selectRaw('COUNT(*) as total')
        ->groupBy('status')
        ->pluck('total', 'status');

     $data = [
        [
            "label"  => OrderStatus::ENATTENTE->label(),
            "filter" => OrderStatus::ENATTENTE->value,
            "count"  => $counts[OrderStatus::ENATTENTE->value] ?? 0,
        ],
        [
            "label"  => OrderStatus::TRAITE->label(),
            "filter" => OrderStatus::TRAITE->value,
            "count"  => $counts[OrderStatus::TRAITE->value] ?? 0,
        ],
        [
            "label"  => OrderStatus::ANNULER->label(),
            "filter" => OrderStatus::ANNULER->value,
            "count"  => $counts[OrderStatus::ANNULER->value] ?? 0,
        ],
    ];

    return OrderStatusStatResource::collection($data);
}


    public function getOrdersbyUser(Request $request)
    {
        $user = auth()->user();
        $orders = Order::with('details')
            ->where('user_id', $user->id)
            ->orderBy('id', 'desc');
        if ($request->has('filter')) {
            $orders->where('status', $request->filter);
        }
        return OrderResource::collection($orders->paginate($this->limitPage));
    }

    public function storeOrder(Request $request)
    {
        $validated = $request->validate([
            'total_price' => 'required|numeric',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
        ]);

        $user = auth()->user();

        $order = Order::create([
            'user_id' => $user->id,
            'lat' => $validated['lat'],
            'lng' => $validated['lng'],
            'priceTotal' => $request->total_price,
            'adresLivraison' => $request->delivery_adress,
            'notified_pharmacies' => [],
        ]);
        foreach ($request->items as $item) {
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'priceUnitaire' => $item['price'],
            ]);
        }

        // ➤ Sélectionner les pharmacies à 2 km
        $pharmacies = Pharmacy::nearby($order->lat, $order->lng, 2)->get();
        $newlyNotified = [];
        // ➤ Broadcast vers chaque pharmacie trouvée
        foreach ($pharmacies as $p) {
            if ($p->pharmacien_id != null) {
                broadcast(new ProduitDemande($order->id, $order->details, 2, $p->id))
                    ->toOthers();
                $newlyNotified[] = $p->id;
            }
        }

        if (! empty($newlyNotified)) {
            $order->update([
                'notified_pharmacies' => $newlyNotified,
            ]);
        }
        dispatch(new BroadcastToPharmaciesJob($order->id, 2, 0))
            ->delay(now()->addMinutes(0));

        return response()->json([
            'message' => 'Commande créée et envoyée aux pharmacies proches.',
            'request_id' => $order->id,
        ]);
    }

    public function cancelOrder(Order $order)
    {
        $order->status=OrderStatus::ANNULER->value;
        $order->save();
        return new OrderResource($order);
    }

    public function findOrder(Order $order)
    {
        return new OrderResource($order);
    }

    public function deleteOrder(Order $order)
    {
        $order->delete();

        return new OrderResource($order);
    }
}
