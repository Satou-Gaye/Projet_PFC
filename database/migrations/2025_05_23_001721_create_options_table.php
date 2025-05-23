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
        Schema::create('options', function (Blueprint $table) {
            $table->id();
            //$table->unsignedBigInteger('niveau_id');
            $table->unsignedBigInteger('semestre_id'); 
            $table->string('nom_option');;
            $table->timestamps();
            
            $table->foreign('semestre_id')->references('id')->on('semestres')->onDelete('cascade');
           // $table->foreign('niveau_id')->references('id')->on('niveaux')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('options');
    }
};
