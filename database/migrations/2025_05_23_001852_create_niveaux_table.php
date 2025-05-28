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
        Schema::create('niveaux', function (Blueprint $table) {
            $table->id();
             $table->unsignedBigInteger('semestre_id');
           // $table->unsignedBigInteger('option_id');
            //$table->unsignedBigInteger('annee_academique_id');
            //$table->string('codeUE');
            $table->string('nom_niveau');            
            $table->timestamps();

            $table->foreignId('codeUE')->onDelete('cascade');
            $table->foreign('semestre_id')->references('id')->on('semestres')->onDelete('cascade');
            //$table->foreign('option_id')->references('id')->on('options')->nullable();
            //$table->foreignId('annee_academique_id')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('niveaux');
    }
};