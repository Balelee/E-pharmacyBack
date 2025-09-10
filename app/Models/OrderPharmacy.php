<?php

namespace App\Models;

use App\Models\Order;
use App\Models\Pharmacy;
use App\Models\Enums\OrderPharmacyStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OrderPharmacy extends BaseModel
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

    protected $appends = [
        'treated_count',
    ];

    public function orderpharmacydetails(): HasMany
    {
        return $this->hasMany(OrderPharmacyDetail::class, 'order_pharmacy_id');
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    // Relation vers la pharmacie
    public function pharmacy(): BelongsTo
    {
        return $this->belongsTo(Pharmacy::class);
    }
    
    public function getTreatedCountAttribute(): int
    {
        return self::where('order_id', $this->order_id)->count();
    }
}
