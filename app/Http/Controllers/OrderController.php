<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Models\Enums\OrderStatus;
use App\Http\Resources\OrderResource;
use App\Http\Controllers\BaseController;

class OrderController extends BaseController
{


    public function getAvailableOrders()
{
    $orders = Order::with('details')
        ->where('orderStatus', OrderStatus::ENATTENTE)
        ->orderBy('id', 'desc')
        ->get();
    return OrderResource::collection($orders);
}
    public function getOrdersbyUser()
{
    $user = auth()->user();
    $orders = Order::with('details')
        ->where('user_id', $user->id)
        ->orderBy('id', 'desc')
        ->get();

    return OrderResource::collection($orders);
}


    public function storeOrder(Request $request)
    {
        $request->validate([
            'total_price' => 'required|numeric',
            'items' => 'required|array',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|numeric|min:0',
        ]);

        $user = auth()->user();

        $order = Order::create([
            'user_id' => $user->id,
            'priceTotal' => $request->total_price,
            'adresLivraison' => $request->delivery_adress,
        ]);
        foreach ($request->items as $item) {
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'priceUnitaire' => $item['price'],
            ]);
        }

        return $this->getOrdersbyUser();
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


    // Action pour le pharmacien de valider ou annuler une commandé

   public function updateStatus(Request $request, Order $order)
{
    $request->validate([
        'orderStatus' => 'required|in:traite,annule',
    ]);

    $order->orderStatus = $request->orderStatus;
    $order->save();

    return new OrderResource($order);
}


public function getOrderValide()
{
    $orders = Order::where('orderStatus', OrderStatus::TRAITE)->get();

    return OrderResource::collection($orders);
}

public function getOrderAnnule()
{
    $orders = Order::where('orderStatus', OrderStatus::ANNULER)->get();

    return OrderResource::collection($orders);
}

}
