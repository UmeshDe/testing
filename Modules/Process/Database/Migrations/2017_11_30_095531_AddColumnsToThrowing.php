<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToThrowing extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('process__throwings', function (Blueprint $table) {
            $table->integer('throwing_input_bags')->nullable();
            $table->integer('throwing_output_bags')->nullable();
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('process__throwings', function (Blueprint $table) {
            $table->dropIfExists('throwing_input_bags')->nullable();
            $table->dropIfExists('throwing_output_bags')->nullable();
        });
    }
}
