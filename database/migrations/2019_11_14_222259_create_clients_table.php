<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nombre');
            $table->string('correo')->nullable();
            $table->string('telefono');
            $table->string('cel')->nullable();
            $table->string('cel2')->nullable();
            $table->smallInteger('is_property')->nullable()->default(0);
            $table->string('medio_contacto')->nullable();
            $table->text('propiedad_interes')->nullable();
            $table->string('precio')->nullable();
            $table->string('titulo_propiedad')->nullable();
            $table->string('clave_interna')->nullable();
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
        Schema::dropIfExists('clients');
    }
}
