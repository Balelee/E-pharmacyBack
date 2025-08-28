<?php

namespace App\Http\Controllers;

use App\Models\Enums\OrderPharmacyStatus;
use App\Models\OrderPharmacy;
use App\Models\OrderPharmacyDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderPharmacyController extends Controller
{

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
                    'message' => 'Cette commande a déjà été traitée par votre pharmacie.'
                ], 403);
            }

            $orderPharmacy = OrderPharmacy::firstOrCreate(
                [
                    'order_id'    => $orderId,
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
                        'order_detail_id'   => $item['id'],
                    ],
                    [
                        'available' => $item['available'],
                        'quantity'  => $item['quantity'],
                        'price'     => $item['price'],
                        'total'     => $item['total'],
                    ]
                );
            }

            DB::commit();

            return response()->json([
                'message' => 'Réponse enregistrée avec succès'
            ]);
        } catch (\Throwable $e) {
            DB::rollBack();

            return response()->json([
                'message' => 'Erreur lors de l’enregistrement',
                'error'   => $e->getMessage(),
            ], 500);
        }
    }
}
