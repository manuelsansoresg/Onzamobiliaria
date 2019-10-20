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
            $table->decimal('price',18,4)->nullable();
            $table->bigInteger('postal_id')->unsigned();
            $table->string('street', 200)->comment('Calle')->nullable();
            $table->string('noInt', 200)->comment('No interior')->nullable();
            $table->string('noExt', 200)->comment('No Exterior')->nullable();
            $table->smallInteger('assessment')->comment('Gravenes si o no')->nullable();
            $table->smallInteger('predial')->comment('predial')->nullable();
            $table->smallInteger('habitar')->comment('Si esta Habitada')->nullable();
            $table->string('document')->comment('Cuenta con documento')->nullable();
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
            $table->smallInteger('status')->default(1)->comment('Estatus si anda activo, cancelado');
            $table->bigInteger('user_id')->nullable()->unsigned()->comment('Id del usuario que lo da de alta');
            $table->bigInteger('user_id_cancel')->nullable()->unsigned()->comment('usuario de quien cancela');
            $table->bigInteger('user_id_capture')->nullable() ->unsigned()->comment('usuario que captura');
            $table->dateTime('date_assignment')->nullable()->comment('Fecha de asignacion');
            $table->dateTime('date_write')->nullable()->comment('Fecha de captura');
            $table->dateTime('date_cancel')->nullable()->comment('Fecha de la cancelacion');
            $table->integer('rooms')->nullable()->comment('Numero de Habitacion');
            $table->integer('bathrooms')->nullable()->comment('Numero de Baños');
            $table->string('pass_easy_broker')->nullable()->comment('Clave de EasyBroke');

            $table->foreign('realstate_id')->references('id')->on('realstates')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('operation_id')->references('id')->on('operations')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('postal_id')->references('id')->on('postal')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('form_pay_id')->references('id')->on('form_payments')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id_capture')->references('id')->on('users')
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
