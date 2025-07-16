<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pilrember extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'medicine_name',
        'start_date',
        'reminder_time',
        'form',
        'frequency',
    ];

    protected $casts = [
        'start_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
