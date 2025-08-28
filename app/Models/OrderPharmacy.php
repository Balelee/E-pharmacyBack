<?php

namespace App\Models;

use App\Models\Order;
use App\Models\Pharmacy;
use Illuminate\Database\Eloquent\Model;
use App\Models\Enums\OrderPharmacyStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OrderPharmacy extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'pharmacy_id',
        'status'
    ];

    protected $casts = [
        'status' => OrderPharmacyStatus::class
    ];

    public function details():HasMany
    {
        return $this->hasMany(OrderPharmacyDetail::class);
    }

    public function order():BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    // Relation vers la pharmacie
    public function pharmacy():BelongsTo
    {
        return $this->belongsTo(Pharmacy::class);
    }
}
