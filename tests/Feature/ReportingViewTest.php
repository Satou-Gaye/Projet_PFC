<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Ec;
use App\Models\Semestre;
use App\Models\Niveau;

class ReportingViewTest extends TestCase
{
    use RefreshDatabase;

    public function test_reporting_view_displays_ecs()
    {
        // Préparation des données
        $niveau = Niveau::factory()->create( );
        $semestre = Semestre::factory()->create( ['niveau_id' => $niveau->id]);

        $ec = Ec::factory()->create([
            'semestre_id' => $semestre->id,
            'nbHeureTotal' => 40,
            'nbHeureSuivi' => 20,
            'Intitule' => 'Programmation'
        ]);

        // Simulation de la vue
        $response = $this->get(route('ecs.index'));

        // Vérification du contenu
        $response->assertStatus(200);
        $response->assertSee('Liste des EC');
        $response->assertSee('Programmation');
        $response->assertSee('50'); // pourcentage progression
    }
}

