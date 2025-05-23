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
        Schema::create('date_mortes', function (Blueprint $table) {
            $table->id();
            //$table->unsignedBigInteger('annee_academique_id');
            $table->date('date_debut');
            $table->date('date_fin');
            $table->enum('type', ['vacances', 'ferie']);
            
            $table->timestamps();
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('date_mortes');
    }
};
