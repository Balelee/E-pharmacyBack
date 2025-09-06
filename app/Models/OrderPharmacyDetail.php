<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderPharmacyDetail extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'order_pharmacy_id',
        'order_detail_id',
        'available',
        'quantity',
        'price',
        'total',
    ];

    protected $casts = [
        'available' => 'boolean',
        'price' => 'double',
        'total' => 'double',
    ];

    public function orderPharmacy(): BelongsTo
    {
        return $this->belongsTo(OrderPharmacy::class);
    }

    public function orderDetail(): BelongsTo
    {
        return $this->belongsTo(OrderDetail::class, 'order_detail_id');
    }
}
