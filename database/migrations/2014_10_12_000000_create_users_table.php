<?php

use App\Models\Enums\UserType;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('google_id')->nullable();
            $table->string('userName')->unique()->nullable();
            $table->string('lastName')->nullable();
            $table->string('firstName')->nullable();
            $table->string('phone', 20)->unique()->nullable();
            $table->string('otp_code')->nullable();
            $table->string('otp_expires_at')->nullable();
            $table->timestamp('otp_verified_at')->nullable();
            $table->date('birthDate')->nullable();
            $table->string('birthPlace')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('password')->nullable();
            $table->enum('userType', UserType::values())->default(UserType::default())->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
