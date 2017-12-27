<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRepackdoneByToRepack extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('process__repacks', function (Blueprint $table) {
           $table->unsignedInteger('repackingdone_by')->references('id')->on('users')->nullable();
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
            $table->dropIfExists('repackingdone_by')->references('id')->on('users')->nullable();
        });
    }
}
