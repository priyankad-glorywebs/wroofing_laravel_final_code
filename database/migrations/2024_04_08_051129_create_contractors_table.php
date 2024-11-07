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
        Schema::create('contractors', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 191)->nullable();
            $table->string('email', 191)->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 191)->nullable();
            $table->enum('status', ['Active', 'Inactive'])->nullable();
            $table->rememberToken();
            $table->string('contact_number', 15)->nullable();
            $table->text('profile_image')->nullable();
            $table->text('banner_image')->nullable();
            $table->string('zip_code', 10)->nullable();
            $table->string('company_name', 191)->nullable();
            $table->json('contractor_portfolio')->nullable();
            $table->string('facebook_id', 191)->nullable();
            $table->string('google_id', 191)->nullable();
            $table->timestamps();
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contractors');
    }
};
