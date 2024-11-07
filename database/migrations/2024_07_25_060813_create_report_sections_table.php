<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('report_sections', function (Blueprint $table) {
            $table->bigIncrements('id'); // Primary Key
            $table->unsignedBigInteger('report_id'); // Foreign Key: Report ID
            $table->unsignedBigInteger('section_type_id'); // Foreign Key: Section Type ID
            $table->text('content'); // JSON-encoded content of the section
            $table->integer('order'); // Order of the section
            $table->enum('status', ['active', 'deactive'])->default('active'); // Status of the section
            $table->timestamps(); // created_at and updated_at
            
            // Foreign key constraints
            $table->foreign('report_id')
                  ->references('id')->on('reports')
                  ->onDelete('cascade');
            
            $table->foreign('section_type_id')
                  ->references('id')->on('section_types')
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
        Schema::dropIfExists('report_sections');
    }
}
