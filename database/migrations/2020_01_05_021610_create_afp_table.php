<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAfpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('afp', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->float('Provida', 4, 2);
            $table->float('Modelo', 4, 2);
            $table->float('Capital', 4, 2);
            $table->float('Cuprum', 4, 2);
            $table->float('Habitat', 4, 2);
            $table->float('Uno', 4, 2);
            $table->float('PlanVital', 4, 2);
            $table->float('IPS', 4, 2);
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
        Schema::dropIfExists('afp');
    }
}
