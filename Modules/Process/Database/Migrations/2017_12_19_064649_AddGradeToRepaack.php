<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGradeToRepaack extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('process__repacks', function (Blueprint $table) {
            $table->unsignedInteger('grade_id')->references('id')->on('admin__grades')->nullable();
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
            $table->dropIfExists('grade_id')->references('id')->on('admin__grades')->nullable();
        });
    }
}
