<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CeateNewRepackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('process__repacks', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->date('repack_date')->nullable();
            $table->dateTime('start_time')->nullable();
            $table->dateTime('end_time')->nullable();
            $table->unsignedInteger('supervisor_id')->references('id')->on('users')->nullable();
            $table->unsignedInteger('carton_id')->references('id')->on('process__cartons')->nullable();
            $table->unsignedInteger('location_id')->references('id')->on('admin__locations')->nullable();
            $table->unsignedInteger('fishtype_id')->references('id')->on('admin__fishtypes')->nullable();
            $table->unsignedInteger('bagcolor_id')->references('id')->on('admin__bagcolors')->nullable();
            $table->unsignedInteger('cartontype_id')->references('id')->on('admin__cartontypes')->nullable();
            $table->string('lot_no')->nullable();
            $table->text('remark')->nullable();
            $table->string('record_status')->nullable()->default("A");
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('process__repacks');
    }
}
