<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProperties extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('realstate_id')->unsigned();
            $table->smallInteger('Avaluo')->comment('Si esta Valuado o no')->nullable();
            $table->bigInteger('operation_id')->unsigned();
            $table->decimal('price',18,4);
            $table->bigInteger('state_id')->unsigned();
            $table->bigInteger('municipality_id')->unsigned();
            $table->bigInteger('location_id')->unsigned();
            $table->string('street', 200)->comment('Calle')->nullable();
            $table->string('noInt', 200)->comment('No interior')->nullable();
            $table->string('noExt', 200)->comment('No Exterior')->nullable();
            $table->smallInteger('assessment')->comment('Gravenes si o no')->nullable();
            $table->smallInteger('predial')->comment('predial')->nullable();
            $table->smallInteger('habitar')->comment('Si esta Habitada')->nullable();
            $table->text('document')->comment('Cuenta con documento')->nullable();
            $table->bigInteger('form_pay_id')->unsigned();
            $table->string('institution')->nullable();
            $table->string('name')->comment('Nombre del Cliente')->nullable();
            $table->string('email')->comment('Email de Cliente')->nullable();
            $table->string('phone_contact')->comment('Telefono del CLiente')->nullable();
            $table->string('celular')->comment('Celular del Cliente')->nullable();
            $table->string('celular2')->comment('Celular del Cliente')->nullable();
            $table->smallInteger('is_property')->comment('Si es propietario')->nullable();
            $table->text('observation1')->comment('Observaciones')->nullable();
            $table->text('observation2')->comment('Observaciones')->nullable();
            $table->text('observation3')->comment('Observaciones')->nullable();
            $table->smallInteger('status')->comment('Estatus si anda activo, cancelado');
            $table->bigInteger('user_id')->unsigned()->comment('Estatus si esta activo o cancelado');
            $table->bigInteger('user_id_cancel')->unsigned()->comment('usuario de quien cancela');
            $table->dateTime('date_write')->nullable()->comment('Fecha de captura');
            $table->dateTime('date_cancel')->nullable()->comment('Fecha de captura');
            $table->integer('rooms')->nullable()->comment('Numero de Habitacion');
            $table->integer('bathrooms')->nullable()->comment('Numero de Baños');
            $table->string('pass_easy_broker')->nullable()->comment('Numero de Baños');

            $table->foreign('realstate_id')->references('id')->on('realstates')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('operation_id')->references('id')->on('operations')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('state_id')->references('id')->on('states')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('municipality_id')->references('id')->on('municipalities')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('location_id')->references('id')->on('locations')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('form_pay_id')->references('id')->on('form_payments')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id_cancel')->references('id')->on('users')
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
        Schema::dropIfExists('properties');
    }
}
