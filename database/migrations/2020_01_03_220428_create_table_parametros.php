<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableParametros extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('table_parametros', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('Modelo', 4, 2);
            $table->float('Habitat', 4, 2);
            $table->float('Provida', 4, 2);
            $table->float('Cuprum', 4, 2);
            $table->float('PlanVital', 4, 2);
            $table->float('Uno', 4, 2);            
            $table->float('UF', 8, 2);
            $table->float('Cesantia', 8, 2);
            $table->float('AsigFamA', 8, 2);
            $table->float('AsigFamB', 8, 2);
            $table->float('AsigFamC', 8, 2);
            $table->float('TopeImpAFP', 10, 2);
            $table->float('TopeImpIPS', 10, 2);
            $table->float('TopeImpSegCesantia', 10, 2);
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
        Schema::dropIfExists('table_parametros');
    }
}
