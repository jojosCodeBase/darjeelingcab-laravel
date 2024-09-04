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
        Schema::create('receipts', function (Blueprint $table) {
            $table->id(); // Primary key for receipts
            $table->unsignedBigInteger('bill_id'); // Foreign key referencing invoices
            $table->unsignedBigInteger('customer_id'); // Foreign key referencing customers
            $table->decimal('amount', 10, 2); // Amount paid
            $table->decimal('balance', 10, 2); // Amount paid
            $table->string('payment_method'); // Payment method (e.g., Credit Card, Cash)
            $table->enum('payment_status', ['Full Paid', 'Advance Paid', 'Failed'])->default('Full Paid'); // Payment status
            $table->date('payment_date'); // Date of payment
            $table->timestamps(); // Created at and updated at

            // Foreign key constraints
            $table->foreign('bill_id')->references('id')->on('bills')->onDelete('cascade');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('receipts');
    }
};
