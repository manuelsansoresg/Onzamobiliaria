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
            $table->bigInteger('realstate_id')->nullable()->unsigned()->comment('Id mobiliria(Casa,Departamento)');
            $table->bigInteger('operation_id')->nullable()->unsigned()->comment('id de operacion(renta,venta,etc)');
            $table->string('phone')->nullable()->comment('Telefono');
            $table->string('mobile')->nullable()->comment('celular');
            $table->smallInteger('share')->nullable()->comment('Compartida si es compartido con otro mobiliria');
            $table->bigInteger('postal_id')->nullable()->unsigned();
            $table->string('street')->nullable()->comment('Calle');
            $table->string('n_in')->nullable()->comment('No interior');
            $table->string('n_out')->nullable()->comment('No Exterior');
            $table->smallInteger('status')->default(1)->comment('Estatus si anda activo, cancelado');
            $table->dateTime('date_write')->nullable()->comment('Fecha de captura');
            $table->bigInteger('user_id')->nullable() ->unsigned()->comment('Estatus si esta activo o cancelado');
            $table->bigInteger('user_id_cancel')->nullable()->unsigned()->comment('usuario de quien cancela');
            $table->dateTime('date_cancel')->nullable()->comment('Fecha de cancelacion');
            $table->bigInteger('clasification_id')->unsigned()->comment('Id mobiliria(Casa,Departamento)');
            $table->text('obseration1')->comment('obsevaciones')->nullable();
            $table->text('obseration2')->comment('obsevaciones')->nullable();
            $table->text('obseration3')->comment('obsevaciones')->nullable();

            
            $table->foreign('realstate_id')->references('id')->on('realstates')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('postal_id')->references('id')->on('postal')
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
