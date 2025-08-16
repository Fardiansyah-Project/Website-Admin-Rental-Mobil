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
        Schema::create('tickets_models', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_number')->unique();
            $table->unsignedBigInteger('id_driver');
            $table->foreign('id_driver')->references('id')->on('drivers_models')->onDelete('cascade');
            $table->string('passenger_name');
            $table->string('destination');
            $table->date('order_date');
            $table->date('departure_date');
            $table->time('departure_time');
            $table->string('seat_number');
            $table->enum('status', ['pending', 'confirmed', 'cancelled', 'success']);
            $table->string('type_carrier');
            $table->string('plate_number'); 
            $table->decimal('price', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets_models');
    }
};
