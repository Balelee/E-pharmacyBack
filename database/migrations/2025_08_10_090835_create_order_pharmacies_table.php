<?php

use App\Models\Order;
use App\Models\Pharmacy;
use Illuminate\Support\Facades\Schema;
use App\Models\Enums\OrderPharmacyStatus;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_pharmacies', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Order::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(Pharmacy::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
             $table->unique(['order_id', 'pharmacy_id']);
            $table->enum('status', OrderPharmacyStatus::values());
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_pharmacies');
    }
};
