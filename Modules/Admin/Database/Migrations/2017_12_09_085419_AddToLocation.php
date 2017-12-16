<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddToLocation extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admin__locations', function (Blueprint $table) {
           $table->string('landmark')->nullable();
           $table->string('street')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admin__locations', function (Blueprint $table) {
            $table->dropIfExists('landmark');
            $table->dropIfExists('street');
        });
    }
}
