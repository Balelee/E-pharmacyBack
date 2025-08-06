<?php

use App\Models\User;
use App\Models\Pharmacy;
use App\Models\Enums\OrderStatus;
use App\Models\Enums\PayementType;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(Pharmacy::class)->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->double('priceTotal');
            $table->enum('orderStatus', OrderStatus::values())->default(OrderStatus::default());
            $table->string('adresLivraison')->nullable();
            $table->enum('modePayement', PayementType::values())->default(PayementType::default())->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
