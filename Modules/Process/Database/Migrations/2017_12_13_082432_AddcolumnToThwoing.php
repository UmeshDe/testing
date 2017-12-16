<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddcolumnToThwoing extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('process__throwings', function (Blueprint $table) {
            $table->dateTime('thowing_start_time')->nullable();
            $table->dateTime('thowing_end_time')->nullable();
            $table->unsignedInteger('thowing_supervisor')->references('id')->on('users')->nullable();
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
