<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPaymentTypesToTransactionsTable extends Migration
{
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            // Adding the payment_types column after payment_status
            $table->string('payment_types')->default('Cards')->after('payment_status');
        });
    }

    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            // Remove the column if rollback is needed
            $table->dropColumn('payment_types');
        });
    }
}

