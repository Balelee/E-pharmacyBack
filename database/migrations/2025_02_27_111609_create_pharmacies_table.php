<?php

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
        Schema::create('pharmacies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pharmacien_id')->nullable();
            $table->foreign('pharmacien_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('name');
            $table->string('adresse');
            $table->string('phone');
            $table->decimal('lat', 10, 5)->nullable();
            $table->decimal('lng', 11, 5)->nullable();
            $table->boolean('is_on_duty')->default(false);
            $table->string('socket_channel')->nullable();
            $table->string('groupe')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pharmacies');
    }
};
