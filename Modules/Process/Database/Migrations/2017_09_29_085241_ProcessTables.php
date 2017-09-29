<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProcessTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('process__products', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->date('product_date')->nullable();
            $table->integer('no_of_cartons')->nullable();
            $table->unsignedInteger('location_id');
            $table->foreign('location')->references('id')->on('profile__locations');

            $table->integer('approval_no')->nullable();
            $table->integer('po_no')->nullable();

            $table->string('lot_no')->nullable();
            $table->string('product_slab')->nullable();
            $table->integer('no_of_cartons')->nullable();
            $table->unsignedInteger('fish_type');
            $table->foreign('fish_type')->references('id')->on('admin__fishtypes');


            $table->string('record_status')->nullable()->default("A");
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('process__cartons', function (Blueprint $table) {
                $table->engine = 'InnoDB';
                $table->increments('id');
                $table->unsignedInteger('product_id')->references('id')->on('process__products');
                $table->date('carton_date')->nullable();
                $table->integer('no_of_cartons')->nullable();
                $table->date('carton_date')->nullable();

                $table->integer('rejected')->nullable();
                $table->integer('loose')->nullable();
                $table->integer('shipped')->nullable();
                $table->integer('local_sale')->nullable();
                $table->integer('waste')->nullable();
                $table->integer('missing')->nullable();

                $table->string('carton_type')->nullable();
                $table->unsignedInteger('bag_color');
                $table->foreign('bag_color')->references('id')->on('profile__bagcolors');

                $table->unsignedInteger('location_id');
                $table->foreign('location')->references('id')->on('profile__locations');
                $table->boolean('qualitycheckdone')->default(false);

                $table->string('record_status')->nullable()->default("A");
                $table->integer('created_by')->nullable();
                $table->integer('updated_by')->nullable();
                $table->integer('deleted_by')->nullable();
                $table->softDeletes();
                $table->timestamps();
        });

        Schema::create('process__cartonlocations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('carton_id')->references('id')->on('process__products')->nullable();
            $table->unsignedInteger('location_id')->references('id')->on('admin__locations')->nullable();

            $table->integer('available_quantity')->nullable();
            $table->integer('transit')->nullable();
            $table->integer('loose')->nullable();
            $table->integer('rejected')->nullable();

            $table->string('record_status')->nullable()->default("A");
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('process__productcodes', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('product_id')->references('id')->on('process__products')->nullable();
            $table->unsignedInteger('code_id')->references('id')->on('admin__codemasters')->nullable();
            $table->string('record_status')->nullable()->default("A");
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('process__qualityparameters', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('carton_id')->references('id')->on('process__cartons');
            $table->unsignedInteger('grade_id');
            $table->date('date');
            $table->foreign('grade')->references('id')->on('admin__grades');
            $table->string('moisture')->nullable();
            $table->string('kamaboko_hw')->nullable();
            $table->string('ashi')->nullable();
            $table->string('contam')->nullable();
            $table->string('ph')->nullable();
            $table->string('work_force')->nullable();
            $table->string('length')->nullable();
            $table->string('gel_strength')->nullable();
            $table->string('suwari_work_force')->nullable();
            $table->string('suwari_length')->nullable();
            $table->string('suwari_gel_strength')->nullable();
            $table->unsignedInteger('approved_by')->references('id')->on('users');
            $table->string('record_status')->nullable()->default("A");
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('process__transfers', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('date');
            $table->integer('vehicle_no')->nullable();
            $table->integer('container_no')->nullable();

            $table->unsignedInteger('loading_location_id')->nullable();
            $table->unsignedInteger('unloading_location_id')->nullable();

            $table->date('loading_date')->nullable();
            $table->timestamp('loading_start_time')->nullable();
            $table->timestamp('loading_end_time')->nullable();
            $table->string('loading_supervisor')->nullable();
            $table->integer('loading_quantity')->nullable();

            $table->date('unloading_date')->nullable();
            $table->timestamp('unloading_start_time')->nullable();
            $table->timestamp('unloading_end_time')->nullable();
            $table->string('unloading_supervisor')->nullable();
            $table->integer('unloading_quantity')->nullable();
            $table->string('status')->nullable();
            $table->string('loading_gate_pass_no')->nullable();
            $table->string('unloading_gate_pass_no')->nullable();
            $table->string('loading_remark')->nullable();
            $table->string('unloading_remark')->nullable();

            $table->string('record_status')->nullable()->default("A");
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('process__transfercartons', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('transfer_id')->references('id')->on('process__transfers')->nullable();

            $table->unsignedInteger('carton_id')->references('id')->on('process__products')->nullable();

            $table->integer('quantity');
            $table->integer('received_quantity');

            $table->string('status')->nullable();
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
        //
    }
}
