<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToShipment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('process__shipments', function (Blueprint $table) {
           $table->string('seal_no')->nullable();
           $table->string('invoice_no')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('process__shipments', function (Blueprint $table) {
            $table->dropIfExists('seal_no')->nullable();
            $table->dropIfExists('invoice_no')->nullable();
        });
    }
}
