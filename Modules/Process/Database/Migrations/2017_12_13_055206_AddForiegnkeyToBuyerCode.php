<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForiegnkeyToBuyerCode extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('process__products', function (Blueprint $table) {
            $table->dropColumn('bc')->nullable();
            $table->unsignedInteger('buyercode_id')->references('id')->on('admin__buyercodes')->nullable();
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
            $table->dropIfExists('bc')->nullable();
            $table->dropIfExists('buyercode_id')->references('id')->on('admin__buyercodes')->nullable();
        });
    }
}
