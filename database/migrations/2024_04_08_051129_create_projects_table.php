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
        Schema::create('projects', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->bigInteger('project_image')->nullable();
            $table->text('roofandgutterdesign')->nullable();
            $table->string('rooftypeandrating')->nullable();
            $table->string('guttertypeaccessories')->nullable();
            $table->string('guttertypeaccessories1')->nullable();
            $table->unsignedBigInteger('user_id')->nullable()->index('projects_user_id_foreign');
            $table->string('name')->nullable();
            $table->string('address')->nullable();
            $table->string('insurance_company')->nullable();
            $table->string('insurance_agency')->nullable();
            $table->string('billing')->nullable();
            $table->string('mortgage_company')->nullable();
            $table->string('project_status', 50)->nullable();
            $table->integer('status')->default(0);
            $table->timestamps();
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
};
