<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends BaseModel
{
    use HasFactory;

    protected $fillable = [
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
    ];

    public static function validationRule()
    {
        return [
            'productName' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string', 'max:255'],
            'price' => ['required', 'numeric'],
            'productType' => ['required', 'string', 'max:255'],
            'stock' => ['required', 'double'],
            'expiredDate' => ['required', 'date'],
            'laborator' => ['required', 'string', 'max:255'],
        ];
    }
}
