<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestPetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_pets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('pet_id')->references('pets')->on('id');
            $table->string('name');
            $table->string('lastName');
            $table->string('email')->nullable();
            $table->integer('telephone')->nullable();
            $table->text('message')->nullable();
            $table->integer('contactTel')->default(0);
            $table->integer('contactEmail')->default(0);
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
        Schema::dropIfExists('request_pets');
    }
}
