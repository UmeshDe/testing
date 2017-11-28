<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddShippedColumnToCartoLocation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('process__cartonlocations', function (Blueprint $table) {
           $table->integer('shipped')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('process__cartonlocations', function (Blueprint $table) {
            $table->dropIfExists('shipped')->default(0);
        });
    }
}
