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
        Schema::create('annee_academiques', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->unsignedBigInteger('date_morte_id');
            $table->unsignedBigInteger('date_extreme_id');
            $table->date('date_debut');
            $table->date('date_fin');
            $table->boolean('demarrer')->default(false);
            $table->timestamps();

            $table->foreign('date_morte_id')->references('id')->on('date_mortes')->onDelete('cascade');
            $table->foreign('date_extreme_id')->references('id')->on('date_extremes')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('annee_academiques');
    }
};
