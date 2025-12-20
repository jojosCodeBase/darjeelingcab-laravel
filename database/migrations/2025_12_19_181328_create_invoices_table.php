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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_no')->unique();
            $table->date('invoice_date');

            // 1. Foreign Keys (NULLABLE for instant invoices)
            $table->foreignId('customer_id')->nullable()->constrained()->onDelete('set null');
            $table->foreignId('booking_id')->nullable()->constrained()->onDelete('set null');

            // 2. Manual Fields (Filled ONLY for instant invoices)
            $table->string('manual_customer_name')->nullable();
            $table->string('manual_customer_phone')->nullable();
            $table->text('manual_customer_address')->nullable();

            // 3. Billing Data (Always filled)
            $table->json('description'); // Array of items
            $table->json('dates');       // Array of dates
            $table->json('price');       // Array of prices
            $table->json('qty');       // Array of prices
            $table->json('amount');      // Array of amounts
            $table->json('vehicle_details')->nullable();      // Array of vehicle details including vehicle no and driver name

            $table->decimal('total_amount', 10, 2);
            $table->decimal('received_amount', 10, 2)->default(0);
            $table->decimal('balance_due', 10, 2);
            $table->string('payment_status'); // unpaid, paid, advance-paid

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
