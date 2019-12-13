<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFormaPagoToHistoricAsigment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('historic_assigments', function (Blueprint $table) {
            $table->string('forma_pago')->after('observacion3')  ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('historic_assigments', function (Blueprint $table) {
            $table->dropColumn('forma_pago');
        });
    }
}
