<?php

use App\Models\Enums\OrderStatus;
use App\Models\Enums\PayementType;
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
            $table->double('priceTotal');
            $table->enum('status', OrderStatus::values())->default(OrderStatus::default());
            $table->string('adresLivraison')->nullable();
            $table->decimal('lat', 10, 7)->nullable();
            $table->decimal('lng', 10, 7)->nullable();
            $table->integer('current_radius')->default(2); // en km
            $table->timestamp('answered_at')->nullable();
            $table->json('notified_pharmacies')->nullable();
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
