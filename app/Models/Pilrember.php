<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
