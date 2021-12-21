<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCheckinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('checkins', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->string('nric');
            $table->string('gender')->nullable();
            $table->string('race')->nullable();
            $table->string('religion')->nullable();
            $table->string('birthdate')->nullable();
            $table->string('checkintime')->nullable();
            $table->string('checkouttime')->nullable();
            $table->string('rollcall')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('checkins');
    }
}
