<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddValidationsToElevesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('eleves', function (Blueprint $table) {
        $table->boolean('inscription_validee')->default(false);
        $table->boolean('tranche1_validee')->default(false);
        $table->boolean('tranche2_validee')->default(false);
        $table->boolean('tranche3_validee')->default(false);
    });
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('eleves', function (Blueprint $table) {
            //
        });
    }
}
