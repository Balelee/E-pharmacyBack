<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'priceUnitaire',
    ];

    protected $casts = [
        'priceUnitaire' => 'double',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    public function getSubTotalAttribute()
    {
        return $this->priceUnitaire * $this->quantity;
    }

    public function getProductNameAttribute()
    {
        return $this->product->productName;
    }
}
