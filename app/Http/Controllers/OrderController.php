<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Resources\OrderResource;

class OrderController extends BaseController
{
    public function getOrders()
    {
        $orders = Order::orderBy('id', 'desc')->get();

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
        $order = Order::create([
            'user_id' => $request->user_id,
            'pharmacy_id' => 2,
            'priceTotal' => $request->total_price,
            'adresLivraison' => $request->delivery_adress
        ]);
        foreach ($request->items as $item) {
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'priceUnitaire' => $item['price'],
            ]);
        }

        return response()->json(['message' => 'Order placed successfully!', 'order' => $order], 201);
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
