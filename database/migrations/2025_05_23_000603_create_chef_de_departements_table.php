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
        Schema::create('chef_de_departements', function (Blueprint $table) {
            $table->id();
           $table->unsignedBigInteger('user_id');
            //$table->unsignedBigInteger('departement_id')->nullable();
            $table->string('nomDpt');
            $table->unsignedBigInteger('departement_id');
            $table->date('date_nomination')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('departement_id')->references('id')->on('departements')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chef_de_departements');
    }
};
