<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIsSeguimientoToPropertyAssigment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('property_assigment', function (Blueprint $table) {
            $table->smallInteger('is_seguimiento')->default(0)->nullable()->after('date_assignment');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('property_assigment', function (Blueprint $table) {
            $table->dropColumn('is_seguimiento');
        });
    }
}
