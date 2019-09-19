<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsSponsorActivities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sponsor_activities', function (Blueprint $table) {
            //
            $table->BigInteger('activity_id')->after('id')->unsigned();
            $table->BigInteger('sponsor_id')->after('idActivity')->unsigned();
            $table->boolean('status')->default(0)->after('idSponsor');

            $table->foreign('activity_id')->references('id')->on('activities');
            $table->foreign('sponsor_id')->references('id')->on('sponsors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sponsor_activities', function (Blueprint $table) {
            //
            $table->dropColumn('idActivity');
            $table->dropColumn('idSponsor');
            $table->dropColumn('status');
        });
    }
}
