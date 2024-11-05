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
        Schema::dropIfExists('reservations');
        Schema::create('reservations', function (Blueprint $table) {
            //$table->id();
            $table->timestamps();
            $table->unsignedInteger('Reservation_id');
            $table->unsignedInteger('Slot_id');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('Slot_id')->references('slot id')->on('slots');
            $table->primary(['Reservation_id']);
            $table->time('Reservation_time');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
