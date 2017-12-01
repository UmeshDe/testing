<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddInspectionDateToQualitycheck extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('process__qualityparameters', function (Blueprint $table) {
            $table->date('inspection_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('process__qualityparameters', function (Blueprint $table) {
            $table->dropIfExists('inspection_date')->nullable();
        });
    }
}
