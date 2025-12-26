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
        Schema::create('sight_seeing_packages', function (Blueprint $table) {
            $table->id();
            $table->string('town_key')->unique(); // e.g., 'darjeeling'
            $table->string('package_name');
            $table->text('description');
            $table->json('fares'); // Stores {"sedan": 2500, "suv": 3000...}
            $table->json('spots'); // Stores ["Tiger Hill", "Batasia Loop"...]
            $table->string('duration');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sight_seeing_packages');
    }
};
