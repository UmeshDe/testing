<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTwoColumnsToShipment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        Schema::table('process__shipments', function (Blueprint $table) {
//           $table->unsignedInteger('varity_id')->references('id')->on('process__shipments')->nullable();
//            $table->unsignedInteger('grade_id')->references('id')->on()
//        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('process__shipments', function (Blueprint $table) {

        });
    }
}
