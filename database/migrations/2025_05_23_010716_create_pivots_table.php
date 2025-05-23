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
        

        /* // Relations entre Semestre et UE
         Schema::create('semestre_ue', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('semestre_id');
            $table->string('codeUE');
            $table->foreign('semestre_id')->references('id')->on('semestres');
            $table->foreign('codeUE')->references('codeUE')->on('ues');
            $table->timestamps();

           // DB::statement("ALTER TABLE semestre_ue add constraint 'semestre_ue_codeue_foreign' foreign key (`codeUE`) refer
            //ences `ues` (`codeUE`) on delete cascade)");
            
        });

         // Relations entre Niveau et UE
         Schema::create('niveau_ue', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('niveau_id');
            $table->string('codeUE');
            $table->foreign('niveau_id')->references('id')->on('niveaux');
            $table->foreign('codeUE')->references('codeUE')->on('ues');
            $table->timestamps();


        });

         // Relations entre Semestre et Niveau
         Schema::create('semestre_niveau', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('niveau_id');
            $table->unsignedBigInteger('semestre_id');
            $table->foreign('semestre_id')->references('id')->on('semestres');
            $table->foreign('niveau_id')->references('id')->on('niveaux');
            $table->timestamps();
        });*/

        Schema::create('semestre_option', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('option_id');
            $table->unsignedBigInteger('semestre_id');
            $table->foreign('option_id')->references('id')->on('options');
            $table->foreign('semestre_id')->references('id')->on('semestres');
            $table->timestamps();
        });

          /*Schema::create('niveau_option', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('option_id');
            $table->unsignedBigInteger('niveau_id');
            $table->foreign('option_id')->references('id')->on('options');
            $table->foreign('niveau_id')->references('id')->on('niveaux');
            $table->timestamps();
        });*/


        //relation entre ue et ec
        /*Schema::create('ues_ecs', function ( Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('ues_id');
            $table->unsignedBigInteger('ecs_id');
            $table->string('codeUE');
            $table->foreign('codeUE')->references('codeUE')->on('ues');
            $table->foreign('codeEC')->references('codeEC')->on('ecs');
        });*/
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       

        //Schema::dropIfExists('semestre_niveau');
        //Schema::dropIfExists('niveau_ue');
        //Schema::dropIfExists('semestre_ue');
        Schema::dropIfExists('semestre_option');
    }
};
