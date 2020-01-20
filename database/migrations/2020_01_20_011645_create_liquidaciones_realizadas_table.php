<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLiquidacionesRealizadasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       // Schema::enableForeignKeyConstraints();
        Schema::create('liquidaciones_realizadas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('objeto_liquidacion');
            $table->integer('mes');
            $table->integer('anio');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->nullable(true);
            $table->boolean('invitado');
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
        Schema::dropIfExists('liquidaciones_realizadas');
    }
}
