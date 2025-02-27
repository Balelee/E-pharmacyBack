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
}
