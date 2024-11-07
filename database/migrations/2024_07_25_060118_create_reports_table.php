<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->bigIncrements('id'); // Primary Key
            $table->unsignedBigInteger('contractor_id'); // Contractor ID
            $table->unsignedBigInteger('project_id'); // Project ID
            $table->string('title'); // Title of the report
            $table->timestamps(); // created_at and updated_at
            
            // Add foreign key constraints
            $table->foreign('contractor_id')
                  ->references('id')->on('contractors')
                  ->onDelete('cascade');
            
            $table->foreign('project_id')
                  ->references('id')->on('projects')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reports');
    }
}
