<?php

namespace App\Models;

use App\Models\Order;
use App\Models\Pharmacy;
use Illuminate\Database\Eloquent\Model;
use App\Models\Enums\OrderPharmacyStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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


      public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Relation vers la pharmacie
    public function pharmacy()
    {
        return $this->belongsTo(Pharmacy::class);
    }
}
