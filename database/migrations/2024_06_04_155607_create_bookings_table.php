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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('party_type');
            $table->string('full_name', 20);
            $table->string('phone_no');
            $table->string('address', 255);
            $table->date('booking_date');
            $table->integer('persons');
            $table->string('vehicle_type', 255);
            $table->integer('days');
            $table->string('pickup_point', 255);
            $table->string('drop_point', 255);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
