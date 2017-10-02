<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AdminTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin__approvalnumbers', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('app_number');
            $table->string('record_status')->nullable()->default("A");
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });


        Schema::create('admin__bagcolors', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('color')->nullable();
            $table->string('record_status')->nullable()->default("A");
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->softDeletes();
            $table->timestamps();

        });

        Schema::create('admin__cartontypes', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('type')->nullable();
            $table->string('record_status')->nullable()->default("A");
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('admin__codemasters', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('code')->nullable();
            $table->unsignedInteger('is_parent')->references('id')->on('admin__codemasters')->nullable();
            $table->string('record_status')->nullable()->default("A");
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('admin__departments', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->unsignedInteger('manager_user_id')->references('id')->on('users')->nullable();
            $table->string('name')->nullable();
            $table->string('department_code')->nullable();
            $table->integer('project_seq_no')->nullable();
            $table->text('description')->nullable();
            $table->boolean('is_automatic')->default(false);
            $table->string('record_status')->nullable()->default("A");
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });


        Schema::create('admin__designations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');

            $table->integer('department_id')->unsigned()->nullable();
            $table->foreign('department_id')->references('id')->on('admin__departments');

            $table->string('designation');
            $table->text('description')->nullable();
            $table->boolean('is_manager')->default(false);

            $table->integer('parent_designation')->unsigned()->nullable();
            $table->foreign('parent_designation')->references('id')->on('admin__departments');

            $table->string('record_status')->nullable()->default("A");
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });


        Schema::create('admin__employees', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');

            $table->unsignedInteger('user_id')->references('id')->on('users')->nullable();


            $table->string('emp_id')->unique();

            $table->integer('designation_id')->unsigned()->nullable();
            $table->foreign('designation_id')->references('id')->on('admin__designations');

            $table->integer('department_id')->unsigned()->nullable();
            $table->foreign('department_id')->references('id')->on('admin__departments');


            $table->string('shift')->nullable();

            $table->date('joining_date')->nullable();
            $table->string('pan_no')->nullable();
            $table->string('adhar_card_no')->nullable();
            $table->string('bank_ac_no')->nullable();
            $table->decimal('salary', 18, 2)->nullable();
            $table->text('previous_company')->nullable();
            $table->boolean('on_probation')->nullable()->default(false);
            $table->boolean('eligible_for_ot')->nullable()->default(false);
            $table->boolean('is_unavailable')->nullable()->default(true);
            $table->integer('deviate_requests_to')->nullable();
            $table->dateTime('last_sign_in_date')->nullable();
            $table->text('qualification')->nullable();
            $table->string('fathers_name')->nullable();
            $table->string('mothers_name')->nullable();
            $table->string('languages_known')->nullable();
            $table->string('family_contact_no')->nullable();
            $table->string('personal_contact_no')->nullable();
            $table->string('bloodgroup')->nullable();
            $table->string('mothertongue')->nullable();
            $table->string('fathers_profession')->nullable();
            $table->string('mothers_profession', 20)->nullable();
            $table->string('marital_status')->nullable();
            $table->string('spouse_name')->nullable();
            $table->integer('no_of_children')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('bank_ifsc_code')->nullable();

            
            $table->unsignedInteger('manager_id')->references('id')->on('users')->nullable();
            $table->string('record_status')->nullable()->default("A");

            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('admin__fishtypes', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('type')->nullable();
            $table->string('record_status')->nullable()->default("A");
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
        Schema::create('admin__grades', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('grade')->nullable();
            $table->string('record_status')->nullable()->default("A");
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('admin__kinds', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('kind')->nullable();
            $table->string('record_status')->nullable()->default("A");
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('admin__locations', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('location')->nullable();
            $table->string('sublocation')->nullable();
            $table->string('details')->nullable();
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
        Schema::dropIfExists('admin__approvalnumbers');
        Schema::dropIfExists('admin__bagcolors');
        Schema::dropIfExists('admin__cartontypes');
        Schema::dropIfExists('admin__codemasters');
        Schema::dropIfExists('admin__departments');
        Schema::dropIfExists('admin__designations');
        Schema::dropIfExists('admin__employees');
        Schema::dropIfExists('admin__fishtypes');
        Schema::dropIfExists('admin__grades');
        Schema::dropIfExists('admin__kinds');
        Schema::dropIfExists('admin__locations');

    }
}
