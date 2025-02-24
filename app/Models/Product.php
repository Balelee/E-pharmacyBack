<?php

namespace App\Models;

use App\Models\Enums\ProductType;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends BaseModel
{
    use HasFactory;

    protected $fillable = [
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
    ];

    public static function validationRule()
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
