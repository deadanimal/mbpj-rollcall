<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Tambahbutiran extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('userrollcalls', function (Blueprint $table) {

            $table->string('keterangan')->nullable();
            $table->string('file_path')->nullable();
        
            $table->foreignId('pegawai_sokong_id')->nullable();
            $table->foreignId('pegawai_lulus_id')->nullable();

            // kelulusan 
            $table->datetime('tarikh_sokong')->nullable();
            $table->boolean('sokong')->nullable();
            $table->text('sokong_sebab')->nullable();
            $table->datetime('tarikh_lulus')->nullable();
            $table->boolean('lulus')->nullable();
            $table->text('lulus_sebab')->nullable();
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
