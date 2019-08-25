<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClasifications extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clasifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('description')->comment('Descripcion Contactado,Finalizado,Compartido,etc');
            $table->smallInteger('status')->comment('Estatus si anda activo, cancelado');
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
        Schema::dropIfExists('clasifications');
    }
}
