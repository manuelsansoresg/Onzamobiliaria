<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPrivadaAndCuotaMantenimientoToProperties extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->smallInteger('privada')->after('is_new')->nullable();
            $table->decimal('cuota_mantenimiento', 18, 4)->after('privada') ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn('privada');
            $table->dropColumn('cuota_mantenimiento');
        });
    }
}
