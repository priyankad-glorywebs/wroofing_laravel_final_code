<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('contractor_id')->index('quotations_contractor_id_foreign');
            $table->unsignedBigInteger('project_id')->index('quotations_project_id_foreign');
            $table->date('due_date')->nullable();
            $table->text('message')->nullable();
            $table->decimal('discount')->nullable()->default(0);
            $table->decimal('tax')->nullable()->default(0);
            $table->decimal('final_price')->nullable()->default(0);
            $table->string('status', 191)->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('quotations');
    }
};
