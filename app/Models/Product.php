<?php

namespace App\Models;

use App\Models\Enums\ProductType;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @mixin IdeHelperProduct
 */
class Product extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'image',
        'name',
        'description',
        'price',
        'type',

    ];

    protected $casts = [
        'type' => ProductType::class,
    ];

    public static function validationRules(): array
    {
        return [
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric'],
            'productType' => ['required', 'string', 'max:255'],
            'expiredDate' => ['required', 'date'],
            'laborator' => ['required', 'string', 'max:255'],
        ];
    }

    public function getImageUrlAttribute()
    {
        return $this->image ? asset('storage/'.$this->image) : null;
    }
}
