<?php

namespace App\Http\Controllers;

use App\Http\Resources\PayementResource;
use App\Models\Payement;

class PayementController extends Controller
{
    public function getPayements()
    {
        $payements = Payement::orderBy('id', 'desc')->get();

        return PayementResource::collection($payements);
    }
}
