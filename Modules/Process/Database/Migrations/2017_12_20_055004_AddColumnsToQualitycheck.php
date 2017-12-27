<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToQualitycheck extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('process__qualityparameters', function (Blueprint $table) {
            $table->string('w1')->nullable();
            $table->string('w2')->nullable();
            $table->string('w3')->nullable();
            $table->string('w4')->nullable();
            $table->string('w5')->nullable();
            $table->string('l1')->nullable();
            $table->string('l2')->nullable();
            $table->string('l3')->nullable();
            $table->string('l4')->nullable();
            $table->string('l5')->nullable();
            $table->string('sw1')->nullable();
            $table->string('sw2')->nullable();
            $table->string('sw3')->nullable();
            $table->string('sw4')->nullable();
            $table->string('sw5')->nullable();
            $table->string('sl1')->nullable();
            $table->string('sl2')->nullable();
            $table->string('sl3')->nullable();
            $table->string('sl4')->nullable();
            $table->string('sl5')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('process__qualityparameters', function (Blueprint $table) {
            $table->dropIfExists('w1')->nullable();
            $table->dropIfExists('w2')->nullable();
            $table->dropIfExists('w3')->nullable();
            $table->dropIfExists('w4')->nullable();
            $table->dropIfExists('w5')->nullable();
            $table->dropIfExists('l1')->nullable();
            $table->dropIfExists('l2')->nullable();
            $table->dropIfExists('l3')->nullable();
            $table->dropIfExists('l4')->nullable();
            $table->dropIfExists('l5')->nullable();
            $table->dropIfExists('sw1')->nullable();
            $table->dropIfExists('sw2')->nullable();
            $table->dropIfExists('sw3')->nullable();
            $table->dropIfExists('sw4')->nullable();
            $table->dropIfExists('sw5')->nullable();
            $table->dropIfExists('sl1')->nullable();
            $table->dropIfExists('sl2')->nullable();
            $table->dropIfExists('sl3')->nullable();
            $table->dropIfExists('sl4')->nullable();
            $table->dropIfExists('sl5')->nullable();
        });
    }
}
