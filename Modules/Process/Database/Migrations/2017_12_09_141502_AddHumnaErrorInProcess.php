<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHumnaErrorInProcess extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('process__products', function (Blueprint $table) {
            $table->integer('human_error_slab')->nullable();
            $table->integer('diff_in_kg')->nullable();
        });

        Schema::table('process__cartons', function (Blueprint $table) {
            $table->integer('human_error_slab')->nullable();
            $table->integer('diff_in_kg')->nullable();
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
            $table->dropIfExists('human_error_slab')->nullable();
            $table->dropIfExists('diff_in_kg')->nullable();
        });

        Schema::table('process__cartons', function (Blueprint $table) {
            $table->dropIfExists('human_error_slab')->nullable();
            $table->dropIfExists('diff_in_kg')->nullable();
        });
    }
}
