<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignTrabajadorIdToLiquidacionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('liquidaciones_realizadas', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('trabajadors_id')->nullable();
            $table->foreign('trabajadors_id')->references('id')->on('trabajadors');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('liquidaciones_realizadas', function (Blueprint $table) {
            //
        });
    }
}
