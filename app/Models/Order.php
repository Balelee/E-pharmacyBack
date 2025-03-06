<?php

namespace App\Models;

use App\Models\Enums\OrderStatus;
use App\Models\Enums\PayementType;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'pharmacy_id',
        'dateOrder',
        'priceTotal',
        'orderStatus',
        'adresLivraison',
        'modePayement',
    ];

    protected $casts = [
        'dateOrder' => 'date',
        'priceTotal' => 'double',
        'orderStatus' => OrderStatus::class,
        'modePayement' => PayementType::class,
    ];
}
