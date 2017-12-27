<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterRepackingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('process__repacks', function (Blueprint $table) {
            $table->dropIfExists('carton_date')->nullable();
            $table->date('repack_date')->nullable();
            $table->removeColumn('comment','remark');
            $table->unsignedInteger('fishtype_id')->references('id')->on('admin__fishtypes')->nullable();
            $table->unsignedInteger('bagcolor_id')->references('id')->on('admin__bagcolors')->nullable();
            $table->unsignedInteger('cartontype_id')->references('id')->on('admin__cartontypes')->nullable();
            $table->string('lot_no')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('process__repacks', function (Blueprint $table) {
            $table->dropIfExists('carton_date')->nullable();
            $table->dropIfExists('repack_date')->nullable();
            $table->dropIfExists('fishtype_id')->references('id')->on('admin__fishtypes')->nullable();
            $table->dropIfExists('bagcolor_id')->references('id')->on('admin__bagcolors')->nullable();
            $table->dropIfExists('cartontype_id')->references('id')->on('admin__cartontypes')->nullable();
            $table->dropIfExists('lot_no')->nullable();
        });
    }
}
