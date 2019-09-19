<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsSponsor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sponsors', function (Blueprint $table) {
            //
            $table->string('sponsor')->after('id');
            $table->text('dedicate')->after('sponsor');
            $table->boolean('status')->default(1)->after('dedicate');
            $table->text('located_at')->after('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Sponsors', function (Blueprint $table) {
            //
            $table->dropColumn('sponsor');
            $table->dropColumn('dedicate');
            $table->dropColumn('located_at');
        });
    }
}
