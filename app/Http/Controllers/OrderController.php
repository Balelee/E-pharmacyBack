<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderResource;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends BaseController
{
    public function getOrders()
    {
        $orders = Order::orderBy('id', 'desc')->get();

        return OrderResource::collection($orders);
    }

    public function storeOrder(Request $request)
    {
        $order = Order::create([
            'user_id' => $request->user_id,
            'pharmacy_id' => $request->pharmacy_id,
            'dateOrder' => $request->dateOrder,
            'orderStatus' => $request->orderStatus,
        ]);

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
