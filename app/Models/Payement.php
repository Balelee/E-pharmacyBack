<?php

namespace App\Models;

use App\Models\Enums\PayementStatus;
use App\Models\Enums\PayementType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperPayement
 */
class Payement extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'user_id',
        'amount',
        'methodPayement',
        'status',
    ];

    protected $casts = [
        'status' => PayementStatus::class,
        'methodPayement' => PayementType::class,
    ];
}
