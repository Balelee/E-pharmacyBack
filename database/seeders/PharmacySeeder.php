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
                'pharmacieName' => 'Pharmacie Barkwendé',
                'adresse' => 'Arrdt 8, Sect 35, Face à la cité de Rimkièta',
                'phone' => '25 40 85 90',
                'latitude'=> 12.37373,
                'longitude'=> -1.60845,
                'is_on_duty' => true,
            ],
            [
                'pharmacieName' => 'Pharmacie Avenir',
                'adresse' => '1200 Lgt, Av. BABANGUIDA face à la station Total',
                'phone' => '25 36 13 38',
                'latitude'=> 12.3752,
                'longitude'=> -1.49387,
                'is_on_duty' => true,
            ],
        ];

        foreach ($pharmaciesData as $data) {
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
