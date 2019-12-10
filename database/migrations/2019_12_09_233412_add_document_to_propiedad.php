<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDocumentToPropiedad extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->string('plano_catastral')->after('cedula_plano_catastral_actualizado')->nullable();
            $table->string('cuota_noadeudo')->after('reglamento_condominios_no_adeudo')->nullable();
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
            $table->dropColumn('plano_catastral');
            $table->dropColumn('cuota_noadeudo');
        });
    }
}
