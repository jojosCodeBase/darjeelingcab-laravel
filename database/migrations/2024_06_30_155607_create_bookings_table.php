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
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('created_by'); // Field to reference the user
            $table->integer('adults');
            $table->integer('child');
            $table->integer('infant');
            $table->json('day_date'); // Store dates as JSON for dynamic days
            $table->json('destination'); // Store destinations as JSON
            $table->json('vehicle_type'); // Store vehicle types as JSON
            $table->json('vehicle_no'); // Store vehicle numbers as JSON
            $table->json('driver_name'); // Store driver names as JSON
            $table->timestamps();

            // Foreign key constraint for the created_by field
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
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
