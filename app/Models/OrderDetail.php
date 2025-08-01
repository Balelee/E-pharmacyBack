<?php

namespace App\Models;

use App\Models\Order;
use App\Models\Product;
use App\Models\BaseModel;
use App\Models\Enums\OrderdetailStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @mixin IdeHelperOrderDetail
 */
class OrderDetail extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'orderDetailStatus',
        'priceUnitaire',
    ];

    protected $casts = [
        'priceUnitaire' => 'double',
        'orderDetailStatus' => OrderdetailStatus::class,
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

    public function getPathUrlAttribute()
    {
        return asset('storage/'.$this->product->productImage);
    }
}
