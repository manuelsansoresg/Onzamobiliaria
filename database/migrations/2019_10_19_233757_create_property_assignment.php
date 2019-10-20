<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePropertyAssignment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_assignment', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('property_id')->unsigned()->nullable();
            $table->string('name')->comment('nombre contacto');
            $table->dateTime('date')->comment('fecha en que se hizo contacto con la persona')->nullable();
            $table->bigInteger('status_follow_id')->unsigned()->nullable()->comment('tipo de espera');
            $table->text('observation1')->comment('Observaciones')->nullable();
            $table->text('observation2')->comment('Observaciones')->nullable();
            $table->text('observation3')->comment('Observaciones')->nullable();

            $table->integer('status_break')->nullable()->comment('controlar si va o no a la bandeja del administrador si pasan 24 hrs');
            $table->integer('status')->nullable()->comment('concluido o no');
            $table->timestamps();

            $table->foreign('property_id')->references('id')->on('properties')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('status_follow_id')->references('id')->on('status_follows')
                ->onUpdate('cascade')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('property_assignment');
    }
}
