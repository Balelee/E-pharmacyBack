<?php

namespace App\Models;

use App\Models\Enums\PayementStatus;
use App\Models\Enums\PayementType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payement extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'user_id',
        'amount',
        'methodPayement',
        'payementStatus',
    ];

    protected $casts = [
        'payementStatus' => PayementStatus::class,
        'methodPayement' => PayementType::class,
    ];
}
