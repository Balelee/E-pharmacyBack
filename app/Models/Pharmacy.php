<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @mixin IdeHelperPharmacy
 */
class Pharmacy extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'pharmacien_id',
        'name',
        'adresse',
        'phone',
        'is_on_duty',
        'lat',
        'lng',
        'groupe',
        'socket_channel',

    ];

    public function pharmacien()
    {
        return $this->belongsTo(User::class, 'pharmacien_id');
    }

    public static function validationRules(): array
    {
        return [

            'name' => ['required', 'string', 'max:255', 'unique:pharmacies,name'],
            'adresse' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string'],

        ];
    }

    public function getPharmacienNameAttribute()
    {
        return $this->pharmacien->userName ?? '';
    }

    public function openingHours()
    {
        return $this->hasMany(OpeningHours::class);
    }

    public function getIsOpenNowAttribute()
    {
        $now = now();
        $today = $now->format('l'); // Monday, Tuesday...

        $openingHour = $this->openingHours->firstWhere('day', $today);

        if (! $openingHour || ! $openingHour->opening_time || ! $openingHour->closing_time) {
            return false;
        }

        return $now->between(
            now()->setTimeFromTimeString($openingHour->opening_time),
            now()->setTimeFromTimeString($openingHour->closing_time)
        );
    }
}
