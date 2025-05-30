<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Ec;
use App\Models\Semestre;
use App\Models\Niveau;
use Illuminate\Support\Facades\View; // N'oubliez pas d'importer la façade View

class SuiviViewTest extends TestCase // Assurez-vous que le nom de la classe correspond au nom du fichier !
{
    use RefreshDatabase;

    /** @test */
    public function la_vue_affiche_correctement_le_reporting_des_cours()
    {
        // Données simulées pour un niveau, semestre, UE et cours
        $resultats = [
            [
                'niveau' => 'L1',
                'progression_niveau' => 75,
                'semestres' => [
                    [
                        'semestre' => 'Semestre 1',
                        'progression_semestre' => 80,
                        'ues' => [
                            [
                                'ue' => 'Mathématiques', // Remarque : vos données utilisent 'ue', votre vue utilise 'module'
                                'cours' => [
                                    [
                                        'Cours' => 'Algèbre',
                                        'Heure_total' => 30,
                                        'Heure_suivie' => 25,
                                        'Heure_restante' => 5,
                                        'Progression' => 83.33,
                                        'Statut' => 'En cours',
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];

        // Rend la vue Blade directement
        // Nous capturons le HTML rendu sous forme de chaîne
        $renderedView = View::make('Suivi.suivi', ['resultats' => $resultats])->render();

        // Pas de assertStatus(200) ici, car nous ne faisons pas de requête HTTP.
        // Au lieu de cela, nous affirmons le contenu de la chaîne du HTML rendu.

        $this->assertStringContainsString('Suivi des cours par niveau, semestre et module', $renderedView);
        $this->assertStringContainsString('Niveau : L1', $renderedView);
        $this->assertStringContainsString('Semestre : Semestre 1', $renderedView);

        // IMPORTANT : Vos données ont 'ue' mais votre vue Blade utilise 'module'.
        // Si votre vue Blade utilise 'Module (UE) : {{ $ue['ue'] }}', alors affirmez 'Module (UE) : Mathématiques'
        // Si votre vue Blade attend une clé nommée 'module' dans $ue, vous devrez peut-être ajuster vos données de test
        $this->assertStringContainsString('Module (UE) : Mathématiques', $renderedView);

        $this->assertStringContainsString('Algèbre', $renderedView);
        $this->assertStringContainsString('30', $renderedView);
        $this->assertStringContainsString('25', $renderedView);
        $this->assertStringContainsString('5', $renderedView);
        $this->assertStringContainsString('83.33%', $renderedView);
        // Remarque : Votre vue a `class="badge {{ $cours['Statut'] === 'Terminé' ? 'Terminer' : 'En cours' }}"`.
        // Le mot 'En cours' apparaîtra directement.
        $this->assertStringContainsString('En cours', $renderedView);
    }
}