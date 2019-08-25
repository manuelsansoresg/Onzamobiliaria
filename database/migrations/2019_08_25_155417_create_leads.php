<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeads extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('date')->nullable()->comment('Fecha de Asignacion');
            $table->bigInteger('furniture_id')->unsigned()->comment('Clasificacion como se mueve el los prospecto');
            $table->bigInteger('operation_id')->unsigned()->comment('id de operacion(renta,venta,etc)');
            $table->string('phone')->nullable()->comment('Telefono');
            $table->string('mobile')->nullable()->comment('celular');
            $table->smallInteger('share')->nullable()->comment('Compartida si es compartido con otro mobiliria');
            $table->bigInteger('state_id')->unsigned();
            $table->bigInteger('municipality_id')->unsigned();
            $table->bigInteger('location_id')->unsigned();
            $table->string('neighborhood')->nullable()->comment('Colonia');
            $table->string('street')->nullable()->comment('Calle');
            $table->integer('n_in')->nullable()->comment('No interior');
            $table->integer('n_out')->nullable()->comment('No Exterior');
            $table->integer('cp')->nullable()->comment('Codigo Postal');
            $table->text('observation')->nullable()->comment('Observaciones');
            $table->smallInteger('status')->comment('Estatus si anda activo, cancelado');
            $table->dateTime('date_write')->nullable()->comment('Fecha de captura');
            $table->bigInteger('user_id')->unsigned()->comment('Estatus si esta activo o cancelado');
            $table->bigInteger('user_id_cancel')->unsigned()->comment('usuario de quien cancela');
            $table->dateTime('date_cancel')->nullable()->comment('Fecha de captura');
            $table->bigInteger('clasification_id')->unsigned()->comment('Id mobiliria(Casa,Departamento)');
            $table->text('obseration1')->comment('obsevaciones')->nullable();
            $table->text('obseration2')->comment('obsevaciones')->nullable();
            $table->text('obseration3')->comment('obsevaciones')->nullable();

            
            $table->foreign('furniture_id')->references('id')->on('furnitures')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('state_id')->references('id')->on('states')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('municipality_id')->references('id')->on('municipalities')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('location_id')->references('id')->on('locations')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id_cancel')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->foreign('clasification_id')->references('id')->on('clasifications')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('operation_id')->references('id')->on('operations')
                ->onUpdate('cascade')->onDelete('cascade');

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
        Schema::dropIfExists('leads');
    }
}
