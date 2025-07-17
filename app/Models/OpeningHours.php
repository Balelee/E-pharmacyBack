<?php

namespace App\Models;

use App\Models\Pharmacy;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @mixin IdeHelperOpeningHours
 */
class OpeningHours extends Model
{
    use HasFactory;

    protected $fillable = [
        'pharmacy_id',
        'day',
        'opening_time',
        'closing_time',
    ];

    public function pharmacy()
    {
        return $this->belongsTo(Pharmacy::class);
    }
}
