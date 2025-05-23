<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Ec;
use App\Models\Semestre;
use App\Models\Niveau;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SuiviViewTest extends TestCase
{
    use RefreshDatabase;

    public function test_la_vue_de_suivi_s_affiche_correctement()
    {
        // Création de données factices
        $niveau = Niveau::factory()->create(['nom_niveau' => 'L1']);
        $semestre = Semestre::factory()->create([
            'nom_semestre' => 'S1',
            'niveau_id' => $niveau->id,
        ]);

        $ec = Ec::factory()->create([
            'Intitule' => 'Mathématiques',
            'nbHeureSuivi' => 10,
            'nbHeureTotal' => 20,
            'semestre_id' => $semestre->id,
        ]);

        // Appeler la route qui retourne cette vue
        $response = $this->get('/ecs/suivi'); // Remplace cette route selon ton projet

        $response->assertStatus(200);
        $response->assertViewIs('ecs.suivi'); // Le nom du fichier blade
        $response->assertViewHas('ecs'); // Vérifie que la variable $ecs est présente

        // Vérifie que certains textes apparaissent
        $response->assertSee('Suivi');
        $response->assertSee('Mathématiques');
        $response->assertSee('Progression');
        $response->assertSee('L1');
        $response->assertSee('S1');
        $response->assertSee('%');
    }
}

