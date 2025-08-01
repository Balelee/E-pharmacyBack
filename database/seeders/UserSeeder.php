<?php

namespace Database\Seeders;

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
                'firstName' => 'admins',
                'phone' => '54738460',
                'birthDate' => '28-09-2000',
                'birthPlace' => 'Koukouldi',
                'email' => 'admins@gmail.com',
                'password' => 'adminadmin',
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
            ],

             [
                'userName' => 'Aymard',
                'lastName' => 'Luc',
                'firstName' => 'Kouame',
                'phone' => '75572006',
                'birthDate' => '28-09-1987',
                'birthPlace' => 'Abidjan',
                'userType' => UserType::PHARMACIEN->value,
                'email' => 'ayarmad@gmail.com',
                'password' => '00000000',
            ],

        ];
    }

    public function run()
    {
        User::truncate();

        foreach ($this->data() as $userData) {
            User::firstOrCreate(
                Arr::only($userData, ['email', 'userName']),
                Arr::only($userData, ['userName', 'lastName', 'firstName', 'phone', 'birthDate', 'birthPlace', 'otp_code', 'password',
                ]),
            );
        }
    }
}
