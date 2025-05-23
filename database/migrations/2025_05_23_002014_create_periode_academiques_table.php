<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('academic_periodes', function (Blueprint $table) {
            $table->id();
            $table->date('date_debut');
            $table->date('date_fin');
            $table->enum('type',['semestre', 'examen', 'date_morte', 'vacances'])->default('semestre');
            $table->string('couleur')->default('#d35400');
            $table->Integer('semaine');
            $table->unsignedBigInteger('niveau_id');
            //$table->unsignedBigInteger('annee_academique_id');
            $table->timestamps();

             $table->foreign('niveau_id')->references('id')->on('niveaux');
            //$table->foreign('annee_academique_id')->references('id')->on('annee_academiques');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('academic_periodes');
    }
};
