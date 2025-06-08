<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Pharmacy;
use App\Models\OpeningHours;
use App\Models\Enums\UserType;
use Illuminate\Database\Seeder; // adapte selon ta config


class PharmacySeeder extends Seeder
{
    public function run()
    {
        $pharmaciesData = [
            [
                'pharmacieName' => 'Pharmacie Centrale',
                'adresse' => '123 Rue Principale',
                'phone' => '0123456789',
                'is_on_duty' => false,
            ],
            [
                'pharmacieName' => 'Pharmacie du Parc',
                'adresse' => '45 Avenue du Parc',
                'phone' => '0987654321',
                'is_on_duty' => true,
            ],
            // ajoute d’autres pharmacies si besoin
        ];

        foreach ($pharmaciesData as $data) {
            // Trouve un pharmacien aléatoire, ou null si aucun
            $pharmacienId = User::where('userType', UserType::PHARMACIEN->value)
                ->inRandomOrder()
                ->first()?->id;

            $pharmacy = Pharmacy::create(array_merge($data, [
                'pharmacien_id' => $pharmacienId,
            ]));

            $this->createWeekSchedule($pharmacy->id);
        }
    }

    private function createWeekSchedule(int $pharmacyId)
    {
        $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

        foreach ($days as $day) {
            OpeningHours::create([
                'pharmacy_id' => $pharmacyId,
                'day' => $day,
                'opening_time' => '08:00:00',
                'closing_time' => $day === 'Saturday' ? '12:00:00' : '18:00:00',
            ]);
        }
    }
}
