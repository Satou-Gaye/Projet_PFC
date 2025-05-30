<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\View; // N'oubliez pas d'importer la façade View
use App\Models\Ec; // Assurez-vous d'importer votre modèle Ec

class EcShowViewTest extends TestCase
{
    use RefreshDatabase; // Utilisez RefreshDatabase si votre modèle Ec interagit avec la base de données

    /** @test */
    public function la_vue_show_affiche_correctement_les_details_du_cours()
    {
        // 1. Créez une instance de votre modèle Ec avec des données de test.
        // Si vous utilisez des factories, c'est encore mieux : Ec::factory()->create([...]);
        $ec = new Ec([
            'intitule' => 'Bases de données avancées',
            'nbHeureTotal' => 60,
            'nbHeureEc' => 30, // Cours magistraux
            'nbHeureTD' => 30, // TD/TP
            'nbHeureSuivi' => 45, // Exemple : cours en cours
        ]);

        // 2. Rendez la vue en lui passant l'objet Ec.
        // Assurez-vous que le chemin de la vue est correct (par exemple, 'ec.show' si elle est dans resources/views/ec/show.blade.php)
        $renderedView = View::make('show', ['ec' => $ec])->render();

        // 3. Effectuez des assertions pour vérifier le contenu
        $this->assertStringContainsString('Détails du cours', $renderedView);
        $this->assertStringContainsString($ec->intitule, $renderedView);
        $this->assertStringContainsString('Nombre d’heures total :', $renderedView);
        $this->assertStringContainsString((string)$ec->nbHeureTotal, $renderedView); // Convertir en string si ce n'est pas déjà le cas
        $this->assertStringContainsString('Cours magistrales :', $renderedView);
        $this->assertStringContainsString((string)$ec->nbHeureEc, $renderedView);
        $this->assertStringContainsString('TD/TP :', $renderedView);
        $this->assertStringContainsString((string)$ec->nbHeureTD, $renderedView);
        $this->assertStringContainsString('Nombre d’heures suivies :', $renderedView);
        $this->assertStringContainsString((string)$ec->nbHeureSuivi, $renderedView);
        $this->assertStringContainsString('Statut :', $renderedView);

        // Testez le statut "En cours"
        $this->assertStringContainsString('En cours', $renderedView);

        // Testez le lien de retour
        $this->assertStringContainsString('href="' . route('suivi_cours') . '"', $renderedView);
        $this->assertStringContainsString('← Retour', $renderedView);

        // Testez un scénario où le statut serait "Terminé"
        $ecTermine = new Ec([
            'Intitule' => 'Programmation Avancée',
            'nbHeureTotal' => 50,
            'nbHeureEc' => 25,
            'nbHeureTD' => 25,
            'nbHeureSuivi' => 50, // Totalement suivi
        ]);
        $renderedViewTermine = View::make('show', ['ec' => $ecTermine])->render();
        $this->assertStringContainsString('Terminé', $renderedViewTermine);
    }
}