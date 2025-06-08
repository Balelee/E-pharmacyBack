<?php

use App\Models\Pharmacy;
use App\Models\Enums\ProductType;
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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Pharmacy::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('productImage')->nullable();
            $table->string('productName');
            $table->string('description');
            $table->double('price');
            $table->enum('productType', ProductType::values())->default(ProductType::default());
            $table->integer('stock');
            $table->date('expiredDate');
            $table->string('laborator');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
