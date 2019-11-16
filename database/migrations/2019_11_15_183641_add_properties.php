<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddProperties extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->bigInteger('client_id')->unsigned()->nullable()->after('pass_easy_broker');
            $table->string('titulo')->nullable()->after('client_id');
            $table->string('clave_interna')->nullable()->after('titulo');
            $table->smallInteger('is_titulo')->nullable()->after('clave_interna');
            $table->string('metros_construccion')->nullable()->after('is_titulo');
            $table->string('metros_terreno')->nullable()->after('metros_construccion');
            $table->string('frente')->nullable()->after('metros_terreno');
            $table->string('fondo')->nullable()->after('frente');
            $table->string('estado_conservacion_antiguedad')->nullable()->after('fondo');
            $table->string('infraestructura_zona')->nullable()->after('estado_conservacion_antiguedad');
            $table->string('identificacion')->nullable()->after('infraestructura_zona');
            $table->string('curp')->nullable()->after('identificacion');
            $table->string('rfc')->nullable()->after('curp');
            $table->string('acta_nacimiento')->nullable()->after('rfc');
            $table->string('acta_matrimonio')->nullable()->after('acta_nacimiento');
            $table->string('predial')->nullable()->after('acta_matrimonio');
            $table->string('no_adeudo_agua')->nullable()->after('predial');
            $table->string('no_adeudo_predial')->nullable()->after('no_adeudo_agua');
            $table->string('cedula_plano_catastral')->nullable()->after('no_adeudo_predial');
            $table->string('cedula_plano_catastral_actualizado')->nullable()->after('cedula_plano_catastral');
            $table->string('copia_escritura')->nullable()->after('cedula_plano_catastral_actualizado');
            $table->string('reglamento_condominios_no_adeudo')->nullable()->after('copia_escritura');

            $table->foreign('client_id')->references('id')->on('clients')
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
        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn('metros_construccion');
            $table->dropColumn('metros_terreno');
            $table->dropColumn('frente');
            $table->dropColumn('fondo');
            $table->dropColumn('estado_conservacion_antiguedad');
            $table->dropColumn('infraestructura_zona');
            $table->dropColumn('identificacion');
            $table->dropColumn('curp');
            $table->dropColumn('rfc');
            $table->dropColumn('acta_nacimiento');
            $table->dropColumn('acta_matrimonio');
            $table->dropColumn('predial');
            $table->dropColumn('no_adeudo_agua');
            $table->dropColumn('no_adeudo_predial');
            $table->dropColumn('cedula_plano_catastral');
            $table->dropColumn('cedula_plano_catastral_actualizado');
            $table->dropColumn('copia_escritura');
            $table->dropColumn('reglamento_condominios_no_adeudo');
        });
    }
}
