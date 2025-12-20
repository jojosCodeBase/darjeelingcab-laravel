<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tour_enquiries', function (Blueprint $table) {
            $table->id();
            $table->string('enq_id');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('from_location');
            $table->string('to_location');
            $table->integer('no_of_pax');
            $table->string('vehicle_type');
            $table->string('start_date');
            $table->string('end_date');
            $table->text('message');
            $table->enum('status', ['new', 'quote_sent', 'confirmed']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tour_enquiries');
    }
};
