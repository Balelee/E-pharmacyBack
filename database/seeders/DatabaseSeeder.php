<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Pharmacy;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        $this->call(UserSeeder::class);
        User::factory(3)->create();
        Pharmacy::factory(3)->create();
        $this->call(ProductSeeder::class);

        Schema::enableForeignKeyConstraints();
    }
}
