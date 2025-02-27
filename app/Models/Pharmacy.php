<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pharmacy extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'pharmacien_id',
        'pharmacieName',
        'adresse',
        'phone',
    ];

    public static function validationRule()
    {
        return [

            'pharmacieName' => ['required', 'string', 'max:255', 'unique:pharmacies,pharmacieName'],
            'adresse' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string'],

        ];
    }
}
