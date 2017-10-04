<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddKindColumnToQuality extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('process__qualityparameters', function (Blueprint $table) {
            $table->unsignedInteger('kind_id')->references('id')->on('admin__kinds');
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

        });
    }
}
