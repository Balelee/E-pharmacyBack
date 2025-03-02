<?php

namespace App\Http\Controllers;

use App\Http\Resources\OrderDetailResource;
use App\Models\OrderDetail;

class OrderDetailController extends Controller
{
    public function findOrderDetail(OrderDetail $orderDetail)
    {
        return new OrderDetailResource($orderDetail);

    }
}
