<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRepackedCartons extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('process__repacks', function (Blueprint $table) {
            $table->integer('repacked_cartons')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('process__repacks', function (Blueprint $table) {
            $table->dropIfExists('repacked_cartons')->nullable();
        });
    }
}
    