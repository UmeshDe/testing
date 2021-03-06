<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Addqcrandicinqualitcheck extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('process__qualityparameters', function (Blueprint $table) {
            $table->string('qcr_pageno')->nullable();
            $table->string('ic')->nullable();
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
            $table->dropIfExists('qcr_pageno')->nullable();
            $table->dropIfExists('ic')->nullable();
        });
    }
}
