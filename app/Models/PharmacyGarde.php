<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @mixin IdeHelperPharmacyGarde
 */
class PharmacyGarde extends Model
{
    use HasFactory;

    protected $fillable = [
        'date_debut',
        'date_fin',
        'groupe',
    ];
}
