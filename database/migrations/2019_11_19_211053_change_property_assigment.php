<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangePropertyAssigment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('property_assignment', function (Blueprint $table) {
          

            $table->string('telefono')->after('name')->nullable();
            $table->string('correo')->after('telefono')->nullable();
            $table->bigInteger('add_id')->after('correo')->unsigned()->nullable();
            $table->bigInteger('asesor_id')->after('add_id')->unsigned()->nullable();

            $table->foreign('add_id')->references('id')->on('ads')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('asesor_id')->references('id')->on('users')
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
        Schema::table('property_assignment', function (Blueprint $table) {
           
            $table->dropColumn('telefono');
            $table->dropColumn('correo');
            $table->dropColumn('add_id');
            $table->dropColumn('asesor_id');

        });
    }
}
