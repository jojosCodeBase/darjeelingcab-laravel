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
        Schema::create('trusted_devices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('browser_fingerprint')->index(); // Hash of UA + IP or Unique ID
            $table->string('device_type'); // e.g., 'desktop', 'mobile'
            $table->string('platform');    // e.g., 'Windows 11', 'iOS'
            $table->string('browser');     // e.g., 'Chrome', 'Safari'
            $table->string('ip_address');
            $table->string('location')->nullable(); // e.g., 'Kolkata, India'
            $table->timestamp('last_active_at')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trusted_devices');
    }
};
