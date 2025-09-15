<?php

namespace Database\Seeders;

use App\Models\Enums\ModelStatus;
use App\Models\User;
use Illuminate\Support\Arr;
use App\Models\Enums\UserType;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    protected function data(): array
    {
        return [
            [
                'userName' => 'Admin',
                'lastName' => 'admin',
                'firstName' => 'owners',
                'phone' => '54738460',
                'birthDate' => '28-09-2000',
                'birthPlace' => 'Koukouldi',
                'email' => 'admin@gmail.com',
                'password' => 'adminadmin',
                'type' => UserType::ADMIN->value,
                'status' => ModelStatus::ACTIF->value,

            ],
            [
                'userName' => 'Aymard',
                'lastName' => 'Luc',
                'firstName' => 'Kouame',
                'phone' => '75572006',
                'birthDate' => '28-09-1987',
                'birthPlace' => 'Abidjan',
                'email' => 'ayarmad@gmail.com',
                'password' => '00000000',
                'type' => UserType::CLIENT->value,
                'status' => ModelStatus::INACTIF->value,
            ],

            [
                'userName' => 'Franck',
                'lastName' => 'Ulrich',
                'firstName' => 'Kouame',
                'phone' => '+22675572009',
                'birthDate' => '28-09-1997',
                'birthPlace' => 'Abidjan',
                'email' => 'franck@gmail.com',
                'password' => '000000001',
                'type' => UserType::CLIENT->value,
                'status' => ModelStatus::INACTIF->value,
            ],

            [
                'userName' => 'kanta',
                'lastName' => 'KANTA',
                'firstName' => 'Fousseini',
                'phone' => '74572004',
                'birthDate' => '28-09-1999',
                'birthPlace' => 'Abidjan',
                'email' => 'kanta@gmail.com',
                'password' => '00000002',
                'type' => UserType::CLIENT->value,
                'status' => ModelStatus::INACTIF->value,
            ],

        ];
    }

    public function run()
    {
        User::truncate();

        foreach ($this->data() as $userData) {
            User::firstOrCreate(
                Arr::only($userData, [
                    'userName',
                    'lastName',
                    'firstName',
                    'email',
                    'phone',
                    'birthDate',
                    'birthPlace',
                    'otp_code',
                    'password',
                    'status',
                    'type'
                ]),
            );
        }
    }
}
