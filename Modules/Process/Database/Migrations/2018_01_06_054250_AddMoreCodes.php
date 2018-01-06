<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMoreCodes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('process__products', function (Blueprint $table) {
           $table->unsignedInteger('i_id')->references('id')->on('admin__codemasters')->nullable();
           $table->unsignedInteger('k_id')->references('id')->on('admin__codemasters')->nullable();
           $table->unsignedInteger('e_id')->references('id')->on('admin__codemasters')->nullable();
           $table->unsignedInteger('t_id')->references('id')->on('admin__codemasters')->nullable();
           $table->unsignedInteger('sg_id')->references('id')->on('admin__codemasters')->nullable();
           $table->unsignedInteger('kg_id')->references('id')->on('admin__codemasters')->nullable();
           $table->unsignedInteger('g_id')->references('id')->on('admin__codemasters')->nullable();
           $table->unsignedInteger('h_id')->references('id')->on('admin__codemasters')->nullable();
           $table->unsignedInteger('rc_id')->references('id')->on('admin__codemasters')->nullable();
           $table->unsignedInteger('mk_id')->references('id')->on('admin__codemasters')->nullable();
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
            $table->dropIfExists('i_id')->references('id')->on('admin__codemasters')->nullable();
            $table->dropIfExists('k_id')->references('id')->on('admin__codemasters')->nullable();
            $table->dropIfExists('e_id')->references('id')->on('admin__codemasters')->nullable();
            $table->dropIfExists('t_id')->references('id')->on('admin__codemasters')->nullable();
            $table->dropIfExists('sg_id')->references('id')->on('admin__codemasters')->nullable();
            $table->dropIfExists('kg_id')->references('id')->on('admin__codemasters')->nullable();
            $table->dropIfExists('g_id')->references('id')->on('admin__codemasters')->nullable();
            $table->dropIfExists('h_id')->references('id')->on('admin__codemasters')->nullable();
            $table->dropIfExists('rc_id')->references('id')->on('admin__codemasters')->nullable();
            $table->dropIfExists('mk_id')->references('id')->on('admin__codemasters')->nullable();
        });
    }
}
