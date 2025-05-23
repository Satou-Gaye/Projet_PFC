<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EcsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonFile = database_path('seeders/data/ues_avec_ecs');
        $data = json_decode(File::get($jsonFile), true);
        foreach($data as $ueData){
            DB::table('ues')->inser([
            'codeUE' => $ueData['codeUE'],
            'Element_Constitutif' =>$ueData['Element_Constitutif'],
             'VHT'=> $ueData['VHT'],
             'Coef'=> $ueData['Coef'],
             'Credit'=> $ueData ['Credit']
            ]);

            foreach($ueData['ecs'] as $ecData){
                DB::table('ecs')->insert([
                    'codeEC' => $ecData['codeEC'],
                    'codeUE' => $ueData['codeUE'],
                    'intitule' => $ecData['intitule'],
                    'statut' => $ecData['statut'],
                    'nbHeureCM'  => ['nbHeureCM'],
                    'nbHeureTD'  => ['nbHeureTD'],
                   'nbTotalHeure' => ['nbTotalHeure']
                ]);
            }
        }
    }
}
