<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveColumnRollcall extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rollcalls', function (Blueprint $table) {
            $table->dropColumn('pegawai_sokong_id');
            $table->dropColumn('pegawai_lulus_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('rollcalls', function (Blueprint $table) {
            $table->string('pegawai_sokong_id')->nullable();
            $table->string('pegawai_lulus_id')->nullable();
        });
    }
}
