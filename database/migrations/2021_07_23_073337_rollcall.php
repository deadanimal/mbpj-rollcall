<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Rollcall extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('rollcalls', function (Blueprint $table) {
            $table->char('staffno',20)->nullable();
            $table->char('tajuk_rollcall',255) ;
            $table->datetime('mula_rollcall');
            $table->datetime('akhir_rollcall');
            $table->char('lokasi', 255);
            $table->text('catatan',255);
            $table->enum('status',['dibuka', 'ditutup','ditangguh']);
            $table->foreignId('pegawai_sokong_id');
            $table->foreignId('pegawai_lulus_id');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
