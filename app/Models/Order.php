<?php

namespace App\Models;

use App\Models\Enums\OrderStatus;
use App\Models\Enums\PayementType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @mixin IdeHelperOrder
 */
class Order extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'priceTotal',
        'status',
        'adresLivraison',
        'lat',
        'lng',
        'current_radius',
        'answered_at',
        'modePayement',
        'notified_pharmacies',
    ];

    protected $casts = [
        'priceTotal' => 'double',
        'status' => OrderStatus::class,
        'modePayement' => PayementType::class,
        'notified_pharmacies' => 'array',
    ];

    public function details(): HasMany
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function getRequestCountAttribute(): int
    {
        return 0;
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function orderPharmacies()
    {
        return $this->hasMany(OrderPharmacy::class);
    }

    public function pharmacies()
    {
        return $this->belongsToMany(Pharmacy::class, 'order_pharmacy')
            ->withPivot('status')
            ->withTimestamps();
    }

    public static function booted()
{
    static::creating(function ($order) {
        $lastNumber = Order::where('user_id', $order->user_id)->max('request_number');
        $order->request_number = $lastNumber ? $lastNumber + 1 : 1;
    });
}

}
