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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->string('customer_id'); // Invoice ID
            $table->string('quote_id'); // Invoice ID
            $table->foreignId('project_id')->constrained()->onDelete('cascade'); // Foreign key for projects table
            $table->decimal('amount', 10, 2); // Amount of the transaction
            $table->decimal('discount', 10, 2)->default(0); // Discount on the amount
            $table->decimal('total', 10, 2); // Total amount after discount
            $table->string('transaction_number')->unique(); // Unique transaction number
            $table->enum('payment_status', ['Completed', 'Failed', 'Pending', 'Refunded']); // Payment status
            $table->timestamps(); // Created and updated timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
