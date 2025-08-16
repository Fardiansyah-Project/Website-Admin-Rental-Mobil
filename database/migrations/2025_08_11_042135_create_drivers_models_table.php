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
        Schema::create('drivers_models', function (Blueprint $table) {
            $table->id();
            $table->string('name_driver');
            $table->string('email')->unique();
            $table->string('phone_number')->unique();
            $table->string('address');
            $table->string('vehicle_type');
            $table->string('vehicle_plate_number')->unique();
            $table->string('license_number')->unique(); 
            $table->enum('status', ['Aktif', 'Tidak sedang berkendara', 'Tersedia'])->default('Tersedia');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drivers_models');
    }
};
