<?php

namespace App\Models;

use App\Models\Pharmacy;
use App\Models\BaseModel;
use App\Models\Enums\ProductType;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @mixin IdeHelperProduct
 */
class Product extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'pharmacy_id',
        'productImage',
        'productName',
        'description',
        'price',
        'productType',
        'stock',
        'expiredDate',
        'laborator',

    ];

    protected $casts = [
        'expiredDate' => 'date',
        'productType' => ProductType::class,
        'stock' => 'integer',
    ];

    public function pharmacy()
    {
        return $this->belongsTo(Pharmacy::class);
    }

    public function getPharmacyNameAttribute()
    {
        return $this->pharmacy->pharmacieName;
    }

    public static function validationRules(): array
    {
        return [
            'productImage' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'productName' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric'],
            'productType' => ['required', 'string', 'max:255'],
            'stock' => ['required', 'double'],
            'expiredDate' => ['required', 'date'],
            'laborator' => ['required', 'string', 'max:255'],
        ];
    }

    public function getImageUrlAttribute()
    {
        return $this->productImage ? asset('storage/'.$this->productImage) : null;
    }
}
