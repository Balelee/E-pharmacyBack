<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Cache;

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

    public function scopeNearby($query, $lat, $lng, $radiusKm = 2)
    {
        return $query->selectRaw('
            id, pharmacien_id, name, lat, lng,
            (6371 * acos(
                cos(radians(?)) * cos(radians(lat)) *
                cos(radians(lng) - radians(?)) +
                sin(radians(?)) * sin(radians(lat))
            )) AS distance
        ', [
            $lat,
            $lng,
            $lat,
        ])
            ->having('distance', '<=', $radiusKm)
            ->orderBy('distance', 'asc');
    }

    public function scopeNearbyClientPosition($query, $lat, $lng)
    {
        return $query->selectRaw('
         pharmacies.*, 
            (6371 * acos(
                cos(radians(?)) * cos(radians(lat)) *
                cos(radians(lng) - radians(?)) +
                sin(radians(?)) * sin(radians(lat))
            )) AS distance
        ', [
            $lat,
            $lng,
            $lat,
        ])

            ->orderBy('distance', 'asc');
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

    public function getIsOpenNowAttribute(): bool
    {
        $now = now();
        $today = $now->format('l'); // ex: Monday, Tuesday...
        $todayDate = $now->toDateString();

        // 🧠 Clé de cache unique par groupe
        $cacheKey = "pharmacy_is_on_duty_{$this->groupe}_{$todayDate}";

        // 🔁 On stocke en cache le résultat de la vérification du service de garde
        $isOnDuty = Cache::remember($cacheKey, now()->addMinutes(5), function () use ($todayDate) {
            return PharmacyGarde::whereDate('date_debut', '<=', $todayDate)
                ->whereDate('date_fin', '>=', $todayDate)
                ->where('groupe', $this->groupe)
                ->exists();
        });

        // Si la pharmacie est de garde → elle est considérée comme ouverte
        if ($isOnDuty) {
            return true;
        }

        // 🕐 Sinon, on vérifie ses horaires normaux
        $openingHour = $this->openingHours->firstWhere('day', $today);

        if (!$openingHour || !$openingHour->opening_time || !$openingHour->closing_time) {
            return false;
        }

        return $now->between(
            now()->setTimeFromTimeString($openingHour->opening_time),
            now()->setTimeFromTimeString($openingHour->closing_time)
        );
    }


    public function orderPharmacies()
    {
        return $this->hasMany(OrderPharmacy::class);
    }

    /*
    De récupérer toutes les commandes associées à une pharmacie.
    De récupérer aussi les infos spécifiques à la relation (comme le status)
    */
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_pharmacy')
            ->withPivot('status')
            ->withTimestamps();
    }
}
