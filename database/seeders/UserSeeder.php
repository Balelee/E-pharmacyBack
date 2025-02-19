<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    protected function data(): array
    {
        return [
            [

                'lastName' => 'admin',
                'firstName' => 'admins',
                'phone' => '54738460',
                'birthDate' => '28-09-2000',
                'birthPlace' => 'Koukouldi'


            ],

            [

                'lastName' => 'Ulrich',
                'firstName' => 'Kouame',
                'phone' => '56738460',
                'birthDate' => '28-09-1997',
                'birthPlace' => 'Abidjan'
            ],


        ];
    }

    public function run()
    {
        User::truncate();

        foreach ($this->data() as $userData) {
            User::firstOrCreate(
                Arr::only($userData, ['phone']),
                Arr::only($userData, ['lastName', 'firstName','phone','birthDate', 'birthPlace','otp_code'
            ]),
            );
        }
    }
}
