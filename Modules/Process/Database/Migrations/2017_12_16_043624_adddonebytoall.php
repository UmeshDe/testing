<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Adddonebytoall extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('process__products', function (Blueprint $table) {
            $table->unsignedInteger('packingdone_by')->references('id')->on('users')->nullable();
        });
        Schema::table('process__qualityparameters', function (Blueprint $table) {
            $table->unsignedInteger('qualitycheckdone_by')->references('id')->on('users')->nullable();
        });
        Schema::table('process__transfers', function (Blueprint $table) {
            $table->unsignedInteger('transferdone_by')->references('id')->on('users')->nullable();
        });
        Schema::table('process__throwings', function (Blueprint $table) {
            $table->unsignedInteger('thowingdone_by')->references('id')->on('users')->nullable();
        });
        Schema::table('process__shipments', function (Blueprint $table) {
            $table->unsignedInteger('shipmentdone_by')->references('id')->on('users')->nullable();
        });
        Schema::table('process__repacks', function (Blueprint $table) {
            $table->unsignedInteger('repackdone_by')->references('id')->on('users')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('process__products', function (Blueprint $table) {
            $table->dropIfExists('packingdone_by')->references('id')->on('users')->nullable();
        });
        Schema::table('process__qualityparameters', function (Blueprint $table) {
            $table->dropIfExists('qualitycheckdone_by')->references('id')->on('users')->nullable();
        });
        Schema::table('process__transfers', function (Blueprint $table) {
            $table->dropIfExists('transferdone_by')->references('id')->on('users')->nullable();
        });
        Schema::table('process__throwings', function (Blueprint $table) {
            $table->dropIfExists('thowingdone_by')->references('id')->on('users')->nullable();
        });
        Schema::table('process__shipments', function (Blueprint $table) {
            $table->dropIfExists('shipmentdone_by')->references('id')->on('users')->nullable();
        });
        Schema::table('process__repacks', function (Blueprint $table) {
            $table->dropIfExists('repackdone_by')->references('id')->on('users')->nullable();
        });
    }
}
