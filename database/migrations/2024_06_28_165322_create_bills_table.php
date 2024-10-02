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
        Schema::create('bills', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->date('bill_date');
            $table->string('bill_no');
            $table->text('vehicle_details');
            $table->string('payment_status');
            $table->json('description');
            $table->json('dates');
            $table->json('price');
            $table->json('amount');
            $table->decimal('sub_total', 12, 2);
            $table->decimal('discount', 12, 2);
            $table->decimal('total_amount', 12, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
