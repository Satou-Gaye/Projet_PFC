<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'nom' => 'Test',
            'prenom' => 'User',
            'email'=> 'test@univ-thies.sn',
            'statut' => 'statut',
            'role' => 'admin',
            'password' => '0000000',
            'departement_id' => 1,
        ]);
       // $this->call([
           // DepartementSeeder::class
         //]);
    }
}
