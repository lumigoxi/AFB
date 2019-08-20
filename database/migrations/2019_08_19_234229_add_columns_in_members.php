<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsInMembers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('members', function (Blueprint $table) {
            //
            $table->string('userName')->after('id');
            $table->string('name')->after('userName');
            $table->string('lastName')->after('name');
            $table->string('password')->after('lastName');
            $table->Integer('idRole')->after('password');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('members', function (Blueprint $table) {
            //
            $tablle->dropColumn('userName');
            $tablle->dropColumn('name');
            $tablle->dropColumn('lastName');
            $tablle->dropColumn('password');
            $tablle->dropColumn('idRole');
        });
    }
}
