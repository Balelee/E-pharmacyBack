<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\User;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @mixin IdeHelperCycle
 */
class Cycle extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'date_debut',
        'date_fin',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getLongueurCycleAttribute()
    {
        return Carbon::parse($this->date_debut)->diffInDays($this->date_fin);
    }
}
