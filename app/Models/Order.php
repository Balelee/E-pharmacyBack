<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'pharmacy_id',
        'dateOrder',
        'orderStatus',
    ];

    protected $casts = [
        'dateOrder' => 'date',
        'orderStatus' => OrderStatus::class,
    ];
}
