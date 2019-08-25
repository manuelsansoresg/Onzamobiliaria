<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatusSeguimiento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('status_seguimientos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('description')->comment('Descripcion del los estatus seguimiento(En Espera del Cliente,En Espera,etc)');
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
        Schema::dropIfExists('status_seguimientos');
    }
}
