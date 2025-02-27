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

    public function pharmacien()
    {
        return $this->belongsTo(User::class, 'pharmacien_id');
    }

    public static function validationRules(): array
    {
        return [

            'pharmacieName' => ['required', 'string', 'max:255', 'unique:pharmacies,pharmacieName'],
            'adresse' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string'],

        ];
    }

    public function getPharmacienNameAttribute()
    {
        return $this->pharmacien->userName;
    }
}
