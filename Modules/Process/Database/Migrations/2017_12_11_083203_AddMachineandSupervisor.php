<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMachineandSupervisor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('process__qualityparameters', function (Blueprint $table) {
            $table->string('machine_moisture')->nullable();
            $table->string('machine_kamaboko_hw')->nullable();
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
            $table->dropIfExists('machine_moisture')->nullable();
            $table->dropIfExists('machine_kamaboko_hw')->nullable();
        });
    }
}
