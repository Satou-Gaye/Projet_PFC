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
        Schema::create('ecs', function (Blueprint $table) {
            $table->string('codeEC')->primary();
            
            $table->string('intitule'); 
           // $table->integer('semestre_id');
            $table->string('codeUE');
            $table->string('statut');
            $table->integer('nbHeureCM');
            $table->integer('nbHeureTD');
            $table->integer('nbTotalHeure');
            $table->integer('nbHeureSuivi')->default(0);
           // $table->check("codeEC LIKE 'INF%'");
            $table->timestamps();

            
            $table->foreign('codeUE')->references('codeUE')->on('ues')->onDelete('cascade');

           
        });

        DB::statement("ALTER TABLE ecs ADD CONSTRAINT check_codeEC CHECK (codeEC LIKE 'INF%')");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ecs');
    }

};
