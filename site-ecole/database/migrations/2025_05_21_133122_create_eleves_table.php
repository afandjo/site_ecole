<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateElevesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::create('eleves', function (Blueprint $table) {
        $table->id();
        $table->string('nom');
        $table->string('prenom');
        $table->date('date_naissance');
        $table->string('lieu_naissance');
        $table->integer('age');
        $table->string('classe');

        // Étape 2 pour 6ème
        $table->string('etablissement_provenance')->nullable();
        $table->string('numero_table_cepd')->nullable();
        $table->decimal('moyenne_cepd', 5, 2)->nullable();

        // Étape 2 pour les autres classes
        $table->decimal('moyenne_1er_trim', 5, 2)->nullable();
        $table->decimal('moyenne_2e_trim', 5, 2)->nullable();
        $table->decimal('moyenne_3e_trim', 5, 2)->nullable();

        $table->string('code_acces')->unique();
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('eleves');
    }
}
