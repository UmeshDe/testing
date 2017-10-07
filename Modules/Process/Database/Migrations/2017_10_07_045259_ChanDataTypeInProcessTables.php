<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChanDataTypeInProcessTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('process__products', function (Blueprint $table) {
            $table->string('po_no')->change()->nullable();
        });

        Schema::table('process__transfers', function (Blueprint $table) {
            $table->string('vehicle_no')->change()->nullable();
            $table->string('container_no')->change()->nullable();
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
            $table->dropColumn('po_no')->nullable();
        });

        Schema::table('process__transfers', function (Blueprint $table) {
            $table->dropColumn('vehicle_no')->nullable();
            $table->dropColumn('container_no')->nullable();
        });
    }
}
