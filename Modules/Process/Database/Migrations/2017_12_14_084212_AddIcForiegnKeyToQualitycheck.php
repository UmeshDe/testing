<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIcForiegnKeyToQualitycheck extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('process__qualityparameters', function (Blueprint $table) {
            $table->dropColumn('ic')->nullable();
            $table->unsignedInteger('ic_id')->references('id')->on('admin__internalcodes')->nullable();
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
            $table->dropIfExists('ic')->nullable();
            $table->dropIfExists('ic_id')->references('id')->on('admin__internalcodes')->nullable();
        });
    }
}
