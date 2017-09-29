<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReportsReportMastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports__reportmasters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('report_name', 255)->nullable();
            $table->string('report_module', 255)->nullable();
            $table->text('report_query')->nullable();
            $table->string('report_type', 255)->nullable();
            $table->string('template_file_id', 45)->nullable();
            $table->string('report_freq', 45)->nullable();
            $table->string('is_mnth_gnrtn', 45)->nullable();
            $table->string('export_formats', 255)->nullable();
            $table->string('rprt_code', 45)->nullable();
            $table->string('record_status')->nullable()->default("A");
            $table->integer('created_by')->nullable();
            $table->integer('updated_by')->nullable();
            $table->integer('deleted_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reports__reportmasters');
    }
}
