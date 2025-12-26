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
        Schema::create('routes', function (Blueprint $table) {
            $table->id();
            $table->string('route_key')->unique(); // e.g., 'njp-darjeeling'
            $table->foreignId('source_id')->constrained('locations');
            $table->foreignId('destination_id')->constrained('locations');
            $table->integer('sedan_fare');
            $table->integer('suv_fare');
            $table->integer('large_suv_fare');
            $table->decimal('distance', 8, 2); // in km
            $table->string('duration'); // e.g., '3 hours'
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('routes');
    }
};
