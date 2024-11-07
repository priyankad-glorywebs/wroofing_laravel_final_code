<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddContractorIdToTransactionsTable extends Migration
{
    public function up()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->unsignedBigInteger('contractor_id')->after('customer_id')->nullable();

            // If you want to add a foreign key constraint:
            // $table->foreign('contractor_id')->references('id')->on('contractors')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn('contractor_id');
            // If you added a foreign key constraint, you may also want to drop that.
            // $table->dropForeign(['contractor_id']);
        });
    }
}
