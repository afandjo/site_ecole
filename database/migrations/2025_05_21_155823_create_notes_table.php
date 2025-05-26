<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notes', function (Blueprint $table) {
    $table->id();
    $table->foreignId('eleve_id')->constrained('eleves')->onDelete('cascade');
    $table->unsignedBigInteger('matiere_id')->nullable()->after('enseignant_id');
    $table->foreign('matiere_id')->references('id')->on('matieres')->onDelete('set null');
    $table->decimal('interrogation_1', 5, 2)->nullable();
    $table->decimal('interrogation_2', 5, 2)->nullable();
    $table->decimal('interrogation_3', 5, 2)->nullable();
    $table->decimal('devoir', 5, 2)->nullable();
    $table->decimal('composition', 5, 2)->nullable();
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
        Schema::dropIfExists('notes');
    }
}
