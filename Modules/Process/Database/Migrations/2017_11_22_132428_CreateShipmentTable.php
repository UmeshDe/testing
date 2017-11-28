<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShipmentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('process__shipments', function (Blueprint $table) {
        $table->engine = 'InnoDB';
        $table->increments('id');
        $table->string('container_no')->nullable();
        $table->string('vehicle_no')->nullable();
        $table->unsignedInteger('location_id')->references('id')->on('process__shipments')->nullable();
        $table->unsignedInteger('supervisor_id')->references('id')->on('users')->nullable();
        $table->string('eqc')->nullable();
        $table->string('temperature')->nullable();
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
        Schema::dropIfExists('process__shipments');
    }
}
