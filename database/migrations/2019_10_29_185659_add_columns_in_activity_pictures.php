<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsInActivityPictures extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('activity_pictures', function (Blueprint $table) {

            
            $table->unsignedBigInteger('activity_id')->change();//
             $table->foreign('activity_id')->references('id')->on('activities');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('activity_pictures', function (Blueprint $table) {
            //
            $table->dropForeign('activities_activity_id_foreign');
        });
    }
}
