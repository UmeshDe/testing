<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCodesInProduction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('process__products', function (Blueprint $table) {
            $table->unsignedInteger('fm_id')->references('id')->on('admin__codemasters')->nullable();
            $table->unsignedInteger('fr_id')->references('id')->on('admin__codemasters')->nullable();
            $table->unsignedInteger('d_id')->references('id')->on('admin__codemasters')->nullable();
            $table->unsignedInteger('s_id')->references('id')->on('admin__codemasters')->nullable();
            $table->unsignedInteger('a_id')->references('id')->on('admin__codemasters')->nullable();
            $table->unsignedInteger('c_id')->references('id')->on('admin__codemasters')->nullable();
            $table->unsignedInteger('p_id')->references('id')->on('admin__codemasters')->nullable();
            $table->unsignedInteger('b_id')->references('id')->on('admin__codemasters')->nullable();
            $table->unsignedInteger('m_id')->references('id')->on('admin__codemasters')->nullable();
            $table->unsignedInteger('w_id')->references('id')->on('admin__codemasters')->nullable();
            $table->unsignedInteger('q_id')->references('id')->on('admin__codemasters')->nullable();
            $table->unsignedInteger('sc_id')->references('id')->on('admin__codemasters')->nullable();
            $table->unsignedInteger('lc_id')->references('id')->on('admin__codemasters')->nullable();
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
            $table->dropIfExists('fm_id')->references('id')->on('admin__codemasters')->nullable();
            $table->dropIfExists('fr_id')->references('id')->on('admin__codemasters')->nullable();
            $table->dropIfExists('d_id')->references('id')->on('admin__codemasters')->nullable();
            $table->dropIfExists('s_id')->references('id')->on('admin__codemasters')->nullable();
            $table->dropIfExists('a_id')->references('id')->on('admin__codemasters')->nullable();
            $table->dropIfExists('c_id')->references('id')->on('admin__codemasters')->nullable();
            $table->dropIfExists('p_id')->references('id')->on('admin__codemasters')->nullable();
            $table->dropIfExists('b_id')->references('id')->on('admin__codemasters')->nullable();
            $table->dropIfExists('m_id')->references('id')->on('admin__codemasters')->nullable();
            $table->dropIfExists('w_id')->references('id')->on('admin__codemasters')->nullable();
            $table->dropIfExists('q_id')->references('id')->on('admin__codemasters')->nullable();
            $table->dropIfExists('sc_id')->references('id')->on('admin__codemasters')->nullable();
            $table->dropIfExists('lc_id')->references('id')->on('admin__codemasters')->nullable();
        });
    }
}
