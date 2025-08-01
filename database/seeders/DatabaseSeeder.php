<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Payement;
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
        //  User::factory(3)->create();
        $this->call(PharmacySeeder::class);
        Order::factory(3)->create();
        $this->call(ProductSeeder::class);
        OrderDetail::factory(3)->create();
        Payement::factory(3)->create();
        $this->call(PharmacyGardeSeeder::class);
        $this->call(TipSeeder::class);

        Schema::enableForeignKeyConstraints();
    }
}
