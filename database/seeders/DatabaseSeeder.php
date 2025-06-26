<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use App\Models\Order;
use App\Models\Payement;
use App\Models\Pharmacy;
use App\Models\OrderDetail;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
use Database\Seeders\ProductSeeder;
use Database\Seeders\PharmacySeeder;
use Illuminate\Support\Facades\Schema;
use Database\Seeders\PharmacyGardeSeeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        $this->call(UserSeeder::class);
        //  User::factory(3)->create();
        $this->call(PharmacySeeder::class);
        Order::factory(3)->create();
        $this->call(ProductSeeder::class);
        OrderDetail::factory(3)->create();
        Payement::factory(3)->create();
        $this->call(PharmacyGardeSeeder::class);

        Schema::enableForeignKeyConstraints();
    }
}
