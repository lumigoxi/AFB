<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsInputPays extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('input_pays', function (Blueprint $table) {
            //
            $table->BigInteger('idSponsorActivity')->unsigned()->after('id');
            $table->BigInteger('idCash')->unsigned()->adter('idSponsorActivity');
            $table->float('amount')->unsigned()->after('idCash');

            $table->foreign('idSponsorActivity')->references('id')->on('sponsor_activities');
            $table->foreign('idCash')->references('id')->on('cashes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('input_pays', function (Blueprint $table) {
            //
            $table->dropColumn('idSponsorActivity');
            $table->dropColumn('idCash');
            $table->dropColumn('amount');
        });
    }
}
