<?php

namespace App\Models;

use App\Models\User;
use App\Models\BaseModel;
use App\Models\OpeningHours;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pharmacy extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'pharmacien_id',
        'pharmacieName',
        'adresse',
        'phone',
        'is_on_duty',
        'latitude',
        'longitude',
        'groupe'

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
        return $this->pharmacien->userName ?? "";
    }

    public function openingHours() {
        return $this->hasMany(OpeningHours::class);
    }

    public function getIsOpenNowAttribute()
{
    $now = now();
    $today = $now->format('l'); // Monday, Tuesday...

    $openingHour = $this->openingHours->firstWhere('day', $today);

    if (!$openingHour || !$openingHour->opening_time || !$openingHour->closing_time) {
        return false;
    }

    return $now->between(
        now()->setTimeFromTimeString($openingHour->opening_time),
        now()->setTimeFromTimeString($openingHour->closing_time)
    );
}

}
