<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsInTreatments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('treatments', function (Blueprint $table) {
            //
            $table->bigInteger('vet_id');
            $table->bigInteger('rescue_id');
            $table->text('description');
            $table->date('start');
            $table->date('end');
            $table->boolean('status');
            $table->double('cost');
            $table->integer('visits_left');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('treatments', function (Blueprint $table) {
            //
            $table->dropColumn('vet_id');
            $table->dropColumn('rescue_id');
            $table->dropColumn('description');
            $table->dropColumn('start');
            $table->dropColumn('end');
            $table->dropColumn('status');
            $table->dropColumn('cost');
            $table->dropColumn('visits_left');
        });
    }
}
