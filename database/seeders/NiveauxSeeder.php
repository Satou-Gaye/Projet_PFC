<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NiveauSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('Niveau')->insert([
            'id' => 1,
            'nom_niveau' => 'L1',
            'id_departement' => 1,
        ]);
    }
}
