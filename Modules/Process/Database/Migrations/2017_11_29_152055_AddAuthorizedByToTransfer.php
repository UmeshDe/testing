<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAuthorizedByToTransfer extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('process__transfers', function (Blueprint $table) {
           $table->unsignedInteger('authorized_by')->references('id')->on('users')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('process__transfers', function (Blueprint $table) {
            $table->dropIfExists('authorized_by')->references('id')->on('users')->nullable();
        });
    }
}
