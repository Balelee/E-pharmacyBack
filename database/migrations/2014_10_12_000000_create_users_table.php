<?php

use App\Models\Enums\UserType;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('userName')->unique();
            $table->string('lastName');
            $table->string('firstName');
            $table->string('phone', 20)->unique();
            $table->string('otp_code')->nullable();
            $table->date('birthDate');
            $table->string('birthPlace');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('userType', UserType::values())->default(UserType::default());
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
