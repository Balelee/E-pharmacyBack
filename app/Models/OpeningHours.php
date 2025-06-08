<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OpeningHours extends Model
{
    use HasFactory;

    protected $fillable = [
        'pharmacy_id',
        'day',
        'opening_time',
        'closing_time'
    ];

    public function pharmacy() {
        return $this->belongsTo(Pharmacy::class);
    }
}
