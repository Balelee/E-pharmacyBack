<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderPharmacyResource;
use App\Http\Resources\OrderResource;
use App\Models\Enums\OrderPharmacyStatus;
use App\Models\Order;
use App\Models\OrderPharmacy;
use App\Models\OrderPharmacyDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderPharmacyController extends Controller
{
    public function getPharmacienWOrders(Request $request)
    {
        $pharmacyId = auth()->user()->pharmacie?->id;

        if (! $pharmacyId) {
            return response()->json([
                'message' => 'Pharmacien non lié à une pharmacie',
            ], 403);
        }

        $query = Order::with('details')
            ->whereJsonContains('notified_pharmacies', $pharmacyId)
            ->orderBy('id', 'desc');
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $orders = $query->get();

        return OrderResource::collection($orders);
    }
    public function getPharmacienTOrROrders(Request $request)
    {
        $pharmacyId = auth()->user()->pharmacie?->id;

        if (! $pharmacyId) {
            return response()->json([
                'message' => 'Pharmacien non lié à une pharmacie',
            ], 403);
        }

        $query = OrderPharmacy::with('orderpharmacydetails.orderDetail')
            ->where('pharmacy_id', $pharmacyId)
            ->orderBy('id', 'desc');
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $ordersPharmacy = $query->get();

        return OrderPharmacyResource::collection($ordersPharmacy);
    }

    public function storeResponse(Request $request, $orderId)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.id' => 'required|integer|exists:order_details,id',
            'items.*.available' => 'required|boolean',
            'items.*.quantity' => 'required|integer|min:0',
            'items.*.price' => 'required|numeric|min:0',
            'items.*.total' => 'required|numeric|min:0',
        ]);

        $pharmacyId = auth()->user()->pharmacie?->id;

        try {
            DB::beginTransaction();
            $orderPharmacy = OrderPharmacy::where('order_id', $orderId)
                ->where('pharmacy_id', $pharmacyId)
                ->first();

            if ($orderPharmacy && $orderPharmacy->status === OrderPharmacyStatus::ACCEPTED) {
                return response()->json([
                    'message' => 'Cette commande a déjà été traitée par votre pharmacie.',
                ], 403);
            }

            $orderPharmacy = OrderPharmacy::firstOrCreate(
                [
                    'order_id' => $orderId,
                    'pharmacy_id' => $pharmacyId,
                ],
                [
                    'status' => OrderPharmacyStatus::ACCEPTED->value,
                ]
            );

            foreach ($request->input('items') as $item) {
                OrderPharmacyDetail::updateOrCreate(
                    [
                        'order_pharmacy_id' => $orderPharmacy->id,
                        'order_detail_id' => $item['id'],
                    ],
                    [
                        'available' => $item['available'],
                        'quantity' => $item['quantity'],
                        'price' => $item['price'],
                        'total' => $item['total'],
                    ]
                );
            }
            DB::commit();

            return response()->json([
                'message' => 'Réponse enregistrée avec succès',
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Erreur lors de l’enregistrement',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
