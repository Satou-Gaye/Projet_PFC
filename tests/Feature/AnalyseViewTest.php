 <?php
namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Illuminate\Support\Facades\View;
use App\Models\Semestre; // Assurez-vous d'importer votre modèle Semestre
use App\Models\Niveau;   // Assurez-vous d'importer votre modèle Niveau

class AnalyseViewTest extends TestCase
{
    use RefreshDatabase; // Utilisez RefreshDatabase car vous travaillez avec des modèles Eloquent

    /** @test */
    public function la_vue_analyse_affiche_correctement_les_donnees()
    {
        // 1. Préparez les données pour le graphique ($semestresChart)
        $semestresChartData = [
            ['Semestre 1', 14],
            ['Semestre 2', 12],
            ['Semestre 3', 10],
            ['Semestre 4', 8] // Pour tester un semestre avec <= 8 semaines
        ];

        // 2. Créez des instances de modèles pour le tableau ($semestres)
        // Assurez-vous que vos modèles Semestre et Niveau ont des factories configurées.
        // Si vous n'avez pas de factories, exécutez :
        // php artisan make:factory SemestreFactory --model=Semestre
        // php artisan make:factory NiveauFactory --model=Niveau

        // Créez quelques niveaux pour les relations
        $niveauL1 = Niveau::factory()->create(['nom_niveau' => 'Licence 1']);
        $niveauL2 = Niveau::factory()->create(['nom_niveau' => 'Licence 2']);

        // Créez des semestres, en associant à des niveaux et en simulant nbSemaines
        $semestres = collect([
            Semestre::factory()->for($niveauL1)->create([
                'nom_semestre' => 'S1',
                'nbSemaines' => 14,
                'created_at' => now()->subWeeks(7), // Simuler un début de semestre pour le calcul de progression
            ]),
            Semestre::factory()->for($niveauL1)->create([
                'nom_semestre' => 'S2',
                'nbSemaines' => 12,
                'created_at' => now()->subWeeks(10),
            ]),
            Semestre::factory()->for($niveauL2)->create([
                'nom_semestre' => 'S3',
                'nbSemaines' => 10,
                'created_at' => now()->subWeeks(3),
            ]),
            // Ce semestre devrait être en rose dans le tableau
            Semestre::factory()->for($niveauL2)->create([
                'nom_semestre' => 'S4',
                'nbSemaines' => 8, // Condition pour la classe 'rose'
                'created_at' => now()->subWeeks(8), // Pour tester la progression à 100%
            ]),
            // Un semestre avec peu de semaines écoulées pour tester la progression
            Semestre::factory()->for($niveauL2)->create([
                'nom_semestre' => 'S5',
                'nbSemaines' => 10,
                'created_at' => now()->subWeeks(1),
            ]),
        ]);


        // 3. Rendez la vue en lui passant les données
        $renderedView = View::make('analyse', [
            'semestresChart' => $semestresChartData,
            'semestres' => $semestres
        ])->render();

        // 4. Effectuez des assertions sur le contenu HTML rendu

        // Assertions pour les titres principaux
        $this->assertStringContainsString('Insights', $renderedView);
        $this->assertStringContainsString('Diagramme des nombres de semaines par semestre', $renderedView);
        $this->assertStringContainsString('Tableau des semestres avec nbSemaine ≤ 8 en rose', $renderedView);
        $this->assertStringContainsString('Progression des semestres par niveau', $renderedView);

        // Assertion pour le script Highcharts
        $this->assertStringContainsString('<script src="https://code.highcharts.com/highcharts.js"></script>', $renderedView);

        // Assertion pour les données du graphique (JSON encodé)
        $this->assertStringContainsString(json_encode($semestresChartData), $renderedView);
        $this->assertStringContainsString("name: 'Semaines'", $renderedView);
        $this->assertStringContainsString("type: 'column'", $renderedView);

        // Assertions pour le premier tableau (avec la classe rose)
        $this->assertStringContainsString('<th>Semestre</th>', $renderedView);
        $this->assertStringContainsString('<th>Niveau</th>', $renderedView);
        $this->assertStringContainsString('<th>Nb de semaines</th>', $renderedView);

        // Vérifiez les données des semestres et la classe 'rose'
        $this->assertStringContainsString('<td>S1</td>', $renderedView);
        $this->assertStringContainsString('<td>Licence 1</td>', $renderedView);
        $this->assertStringContainsString('<td>14</td>', $renderedView); // S1
        $this->assertStringContainsString('<td>S2</td>', $renderedView);
        $this->assertStringContainsString('<td>12</td>', $renderedView); // S2
        $this->assertStringContainsString('<td>S3</td>', $renderedView);
        $this->assertStringContainsString('<td>10</td>', $renderedView); // S3

        // Test de la classe 'rose' pour S4 (nbSemaines <= 8)
        $this->assertStringContainsString('<tr class="rose">', $renderedView);
        $this->assertStringContainsString('<td>S4</td>', $renderedView);
        $this->assertStringContainsString('<td>Licence 2</td>', $renderedView);
        $this->assertStringContainsString('<td>8</td>', $renderedView); // S4

        // Assertions pour le deuxième tableau (progression)
        $this->assertStringContainsString('<th>Nb semaines prévues</th>', $renderedView);
        $this->assertStringContainsString('<th>Nb semaines écoulées</th>', $renderedView);
        $this->assertStringContainsString('<th>Progression</th>', $renderedView);

        // Vérifiez les données de progression (les valeurs précises de progression dépendent de `now()`)
        // Nous pouvons au moins vérifier la présence des noms de semestre et des pourcentages
        $this->assertStringContainsString('<td>S1</td>', $renderedView);
        $this->assertStringContainsString('<td>S2</td>', $renderedView);
        $this->assertStringContainsString('<td>S3</td>', $renderedView);
        $this->assertStringContainsString('<td>S4</td>', $renderedView);
        $this->assertStringContainsString('<td>S5</td>', $renderedView);
        $this->assertStringContainsString('%</td>', $renderedView); // Assurez-vous qu'il y a un pourcentage

        // Pour une vérification plus précise de la progression, vous pouvez mocker la fonction now()
        // ou calculer la progression attendue et l'asserter.
        // Exemple (non inclus directement pour ne pas compliquer l'exemple de base) :
        // use Mockery;
        // Mockery::mock('alias:Carbon\Carbon')->shouldReceive('now')->andReturn(Carbon::parse('2025-01-01'));
        // puis calculer $nbPassees et $progression attendus pour S4 par exemple.
    }
}