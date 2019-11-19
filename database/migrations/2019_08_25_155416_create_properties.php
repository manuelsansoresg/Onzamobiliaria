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
            $table->bigInteger('realstate_id')->comment('departamento-local-terreno')->unsigned();
            $table->smallInteger('Avaluo')->comment('Si esta Valuado o no')->nullable();
            $table->bigInteger('operation_id')->comment('preventa-venta-renta')->unsigned();
            $table->decimal('price',18,4)->nullable();
            $table->bigInteger('postal_id')->unsigned();
            $table->string('address', 200)->comment('Calle')->nullable();
            $table->smallInteger('assessment')->comment('Gravenes si o no')->nullable();
            $table->smallInteger('is_predial')->comment('tiene predial')->nullable();
            $table->smallInteger('habitar')->comment('Si esta Habitada')->nullable();
            $table->string('document')->comment('Cuenta con documento')->nullable();
            
            $table->string('institution')->nullable();
            $table->string('saldo')->nullable();
            
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
            
            $table->string('pass_easy_broker')->nullable()->comment('Clave de EasyBroke');

            $table->foreign('realstate_id')->references('id')->on('realstates')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('operation_id')->references('id')->on('operations')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('postal_id')->references('id')->on('postal')
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
