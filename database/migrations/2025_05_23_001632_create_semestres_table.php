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
        Schema::create('semestres', function (Blueprint $table) {
            $table->id();
            $table->string('codeUE')->default(1);
            //$table->unsignedBigInteger('niveau_id');
            //$table->unsignedBigInteger('annee_academique_id');
            $table->string('nom_semestre');
            $table->integer('nbSemaines')->default(0);
            $table->timestamps();
            //$table->unsignedBigInteger('annee_academique_id');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('semestres');
    }
};
