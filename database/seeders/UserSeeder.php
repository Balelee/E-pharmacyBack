<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

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
                'password' => '00000000',
            ],

            [
                'userName' => 'Franck',
                'lastName' => 'Ulrich',
                'firstName' => 'Kouame',
                'phone' => '56738460',
                'birthDate' => '28-09-1997',
                'birthPlace' => 'Abidjan',
                'email' => 'franck@gmail.com',
                'password' => '000000001',
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
