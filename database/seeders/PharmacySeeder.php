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
                'pharmacieName' => 'Pharmacie Avenir',
                'adresse' => '1200 Lgt, Av. BABANGUIDA face à la station Total',
                'phone' => '25 36 13 38',
                'latitude'=> 12.3752,
                'longitude'=> -1.49387,
                'is_on_duty' => true,
            ],
            [
                'pharmacieName' => 'Pharmacie Baowendsom',
                'adresse' => "Tampouy sur le ouveau goudron du collège Notre Dame de l'Espérance non loin de la ,La Roche",
                'phone' => '25 41 44 99',
                'latitude'=> 12.3752,
                'longitude'=> -1.49387,
                'is_on_duty' => true,
            ],
            [
                'pharmacieName' => 'Pharmacie Barkwendé',
                'adresse' => 'Arrdt 8, Sect 35, Face à la cité de Rimkièta',
                'phone' => '25 40 85 90',
                'latitude'=> 12.37373,
                'longitude'=> -1.60845,
                'is_on_duty' => true,
            ],
           
            [
                'pharmacieName' => 'Pharmacie Beatitudes',
                'adresse' => 'Blvd. France-Afrique Ouaga 2000 en face de la cité Azimo',
                'phone' => '25 37 47 11',
                'latitude'=> 12.3752,
                'longitude'=> -1.49387,
                'is_on_duty' => true,
            ],
            [
                'pharmacieName' => 'Pharmacie Benaia',
                'adresse' => 'Katre-yaare ex secteur 29',
                'phone' => '25 37 28 30',
                'latitude'=> 12.3752,
                'longitude'=> -1.49387,
                'is_on_duty' => false,
            ],
            [
                'pharmacieName' => 'Pharmacie Bonheur',
                'adresse' => "Bonheur Ville à 100 mètres de l'Eglise du 75ème anniversaire",
                'phone' => '63 73 81 82',
                'latitude'=> 12.3752,
                'longitude'=> -1.49387,
                'is_on_duty' => false,
            ],
            [
                'pharmacieName' => 'Pharmacie Camille',
                'adresse' => "Av. Charles De Gaules - Hôtel des finances de Dassasgho",
                'phone' => '25 36 61 27',
                'latitude'=> 12.3752,
                'longitude'=> -1.49387,
                'is_on_duty' => false,
            ],
            [
                'pharmacieName' => 'Pharmacie Centre',
                'adresse' => "460, Av de la nation collée à Telecel siège",
                'phone' => '25 31 16 60',
                'latitude'=> 12.3752,
                'longitude'=> -1.49387,
                'is_on_duty' => false,
            ],
            [
                'pharmacieName' => 'Pharmacie Crystal',
                'adresse' => "Face à la nouvelle Mairie de l'Arrdt 9; vers Centre Medical DON ORIONE, sect 38",
                'phone' => '60 46 08 08',
                'latitude'=> 12.3752,
                'longitude'=> -1.49387,
                'is_on_duty' => false,
            ],
            [
                'pharmacieName' => 'Pharmacie Des Apôtres',
                'adresse' => "Arrdt 12, Sect 52 non loin de l'Eglise catholique Notre Dame des Apôtres",
                'phone' => '25 38 03 82',
                'latitude'=> 12.3752,
                'longitude'=> -1.49387,
                'is_on_duty' => false,
            ],
            [
                'pharmacieName' => 'Pharmacie Desa',
                'adresse' => "Tanghin, non loin de Hôtel Ricardo",
                'phone' => '25 47 50 50',
                'latitude'=> 12.3752,
                'longitude'=> -1.49387,
                'is_on_duty' => false,
            ],
            [
                'pharmacieName' => 'Pharmacie Diaby',
                'adresse' => "Face au Festival des Glaces à koulouba",
                'phone' => '25 33 50 00',
                'latitude'=> 12.3752,
                'longitude'=> -1.49387,
                'is_on_duty' => true,
            ],
            [
                'pharmacieName' => 'Pharmacie El-wanoogo',
                'adresse' => "A côté du Marché de Wayalghin, non loin de la Clinique de l'Est",
                'phone' => '25 40 70 22',
                'latitude'=> 12.3752,
                'longitude'=> -1.49387,
                'is_on_duty' => true,
            ],
            [
                'pharmacieName' => 'Pharmacie Elite',
                'adresse' => "Avenue Yennega route de Yagma",
                'phone' => '25 41 91 77',
                'latitude'=> 12.3752,
                'longitude'=> -1.49387,
                'is_on_duty' => true,
            ],
            [
                'pharmacieName' => 'Pharmacie Hope',
                'adresse' => "Route de fada, Nioko 1, Saaba en allant vers la Consolatrice",
                'phone' => '71 14 22 22',
                'latitude'=> 12.3752,
                'longitude'=> -1.49387,
                'is_on_duty' => true,
            ],
            [
                'pharmacieName' => 'Pharmacie Jober',
                'adresse' => "Immeuble SIMPORE Avenue Dieudonné",
                'phone' => '25 45 51 75',
                'latitude'=> 12.3752,
                'longitude'=> -1.49387,
                'is_on_duty' => true,
            ],
            [
                'pharmacieName' => 'Pharmacie Kaboré Dominiq',
                'adresse' => "200 mètres du rond-pooint de la Patte d'oie, sur le blvd des Martyrs(ou blvd France-Afrique)",
                'phone' => '25 38 48 84',
                'latitude'=> 12.3752,
                'longitude'=> -1.49387,
                'is_on_duty' => true,
            ],
            [
                'pharmacieName' => 'Pharmacie Katra',
                'adresse' => "Située à Kalgondé après la gare RAHIMO",
                'phone' => '25 36 61 27',
                'latitude'=> 12.3752,
                'longitude'=> -1.49387,
                'is_on_duty' => true,
            ],
            [
                'pharmacieName' => 'Pharmacie Keneya',
                'adresse' => "Avenue Oumarou KANAZOE porte 734 côté ouest mur lycée Municipal BAMBATA",
                'phone' => '25 30 71 38',
                'latitude'=> 12.3752,
                'longitude'=> -1.49387,
                'is_on_duty' => true,
            ],
            [
                'pharmacieName' => 'Pharmacie Kossodo',
                'adresse' => "En face de l'abattoir de Kossodo, après la BOA",
                'phone' => '25 35 63 04',
                'latitude'=> 12.3752,
                'longitude'=> -1.49387,
                'is_on_duty' => true,
            ],
            [
                'pharmacieName' => 'Pharmacie Lanibougna',
                'adresse' => "Tanghin, quartier Nonghin, non loin de la Station Radar",
                'phone' => '25 48 07 97',
                'latitude'=> 12.3752,
                'longitude'=> -1.49387,
                'is_on_duty' => true,
            ],
            [
                'pharmacieName' => 'Pharmacie Lanzané',
                'adresse' => "En face de l'Auto-Ecole Magnificat à la Zone Une (1)",
                'phone' => '25 47 10 65',
                'latitude'=> 12.3752,
                'longitude'=> -1.49387,
                'is_on_duty' => true,
            ],
            [
                'pharmacieName' => 'Pharmacie Les Champions',
                'adresse' => "A environ 100 mètres du marché de 14 Yaar",
                'phone' => '51 00 15 25',
                'latitude'=> 12.3752,
                'longitude'=> -1.49387,
                'is_on_duty' => true,
            ],
            [
                'pharmacieName' => 'Pharmacie Liberté',
                'adresse' => "60m de la station SHELL de la cité an III, en direction du marché Sankar-yaare",
                'phone' => '25 30 74 52',
                'latitude'=> 12.3752,
                'longitude'=> -1.49387,
                'is_on_duty' => true,
            ],
            [
                'pharmacieName' => 'Pharmacie Lina',
                'adresse' => "Avenue Kwamé N'Krumah non loin du Paradis des Meilleurs Vins",
                'phone' => '73 48 35 65',
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
                'closing_time' => $day === 'Saturday' ? '12:00:00' : '  20:00:00',
            ]);
        }
    }
}
