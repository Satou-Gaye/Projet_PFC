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
            $table->unsignedBigInteger('option_id');
            $table->unsignedBigInteger('annee_academique_id');
            $table->nsignedBigInteger('codeUE');
            $table->string('nom_niveau');            
            $table->timestamps();

            $table->foreign('codeUE')->references('codeUE')->on('ues')->onDelete('cascade');
            $table->foreign('semestre_id')->references('id')->on('options')->onDelete('cascade');
            $table->foreign('option_id')->references('id')->on('options')->nullable();
            $table->foreign('annee_academique_id')->references('id')->on('annee_academiques')->onDelete('cascade');
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