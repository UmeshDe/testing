<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTwoColumnsToShipment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('process__shipments', function (Blueprint $table) {
            $table->string('photo')->nullable();
            $table->string('grade')->nullable();
            $table->string('approval_no')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('process__shipments', function (Blueprint $table) {
            $table->dropIfExists('photo')->nullable();
            $table->dropIfExists('grade')->nullable();
            $table->dropIfExists('approval_no')->nullable();
        });
    }
}
