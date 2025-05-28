<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $guardName = 'web';
    // attribution d'ensembles des perissions
        $permissions = [
            'access dashboard',
            'manager user',
            'edit users',
            'delete users',
            'access annee_academique.view',
            'access Reporting.view',
            'access Suivi.view',
            'access Insight.view'
        ];
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission ,'guard_name'=>'web']);
        } 

                $admin = Role::firstOrCreate(['name' => 'admin' , 'guard_name'=>'web']);
        $chefDeDepartement = Role::firstOrCreate(['name' => 'chef_de_departement','guard_name'=>'web']);
        $chefDeFilliere = Role::firstOrCreate(['name' => 'chef_de_filliere' , 'guard_name'=>'web']);
        $assistant = Role::firstOrCreate(['name' => 'assistant_departement' ,'guard_name'=>'web']);

        $admin->givePermissionTo(Permission::all());
        $chefDeDepartement->givePermissionTo(['access dashboard', 'access annee_academique.view', 'access Reporting.view', 'access Suivi.view', 'access Insight.view']);
        $chefDeFilliere->givePermissionTo(['access dashboard', 'access annee_academique.view', 'access Reporting.view', 'access Suivi.view', 'access Insight.view']);
        $assistant->givePermissionTo(['access dashboard' ,'access Reporting.view', 'access Suivi.view', 'access Insight.view' ]);

    }
}
