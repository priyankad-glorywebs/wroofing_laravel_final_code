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
        Schema::create('project_documents', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('project_id')->index('project_documents_project_id_foreign');
            $table->string('document_name');
            $table->string('document_file');
            $table->string('file_keys')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('created_by')->nullable()->index('project_documents_created_by_foreign');
            $table->unsignedBigInteger('updated_by')->nullable()->index('project_documents_updated_by_foreign');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('project_documents');
    }
};
