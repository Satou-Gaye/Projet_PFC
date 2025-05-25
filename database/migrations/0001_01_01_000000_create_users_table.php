<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{ 

    const ROLE_ADMIN = 'admin';
    const ROLE_CHEF_DEPARTEMENT = 'chef_departement';
    const ROLE_CHEF_FILLERE = 'chef_filliere';
    const ROLE_ASSISTANTE = 'assistante';

    protected $fillable = [
        'email', 'password', 'role',
    ];


    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('email')->unique()->check("email LIKE '%@univ-thies.sn'");
            $table->string('statut')->check("'statut' IN ('actif','inactif')");
            $table->string('role');
            $table->dateTime('validite_debut')->nullable();
            $table->dateTime('validite_fin')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->unsignedBigInteger('departement_id')->nullable();
            $table->string('role')->default('assistante'); // ou null si préférable
            $table->rememberToken();
            $table->timestamps();

            
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
