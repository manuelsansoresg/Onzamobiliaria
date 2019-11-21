<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoricAssigmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historic_assigments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('property_assignment_id')->unsigned();
            $table->text('observacion1')->nullable();
            $table->text('observacion2')->nullable();
            $table->text('observacion3')->nullable();
            $table->bigInteger('status_follow_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('property_assignment_id')->references('id')->on('property_assignment')
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
        Schema::dropIfExists('historic_assigments');
    }
}
