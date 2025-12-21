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
        Schema::create('login_activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable(); // Nullable for failed attempts on non-existent users
            $table->string('event_name'); // 'Admin Login' or 'Failed Attempt'
            $table->string('ip_address');
            $table->string('location')->nullable();
            $table->string('status'); // 'Success' or 'Denied'
            $table->text('user_agent');
            $table->timestamp('created_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('login_activities');
    }
};
