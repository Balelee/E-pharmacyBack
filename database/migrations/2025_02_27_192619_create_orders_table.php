<?php

use App\Models\Enums\OrderStatus;
use App\Models\Enums\PayementType;
use App\Models\Pharmacy;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->foreignIdFor(Pharmacy::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('dateOrder');
            $table->double('priceTotal');
            $table->enum('orderStatus', OrderStatus::values())->default(OrderStatus::default());
            $table->string('adresLivraison');
            $table->enum('modePayement', PayementType::values())->default(PayementType::default());
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
