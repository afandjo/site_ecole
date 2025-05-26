<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateEnseignantsTableAddPrenoms extends Migration
{
    public function up()
    {
        Schema::table('enseignants', function (Blueprint $table) {
            if (!Schema::hasColumn('enseignants', 'prenoms')) {
                $table->string('prenoms')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('enseignants', function (Blueprint $table) {
            if (Schema::hasColumn('enseignants', 'prenoms')) {
                $table->dropColumn('prenoms');
            }
        });
    }
}
