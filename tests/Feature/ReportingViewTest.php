<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\Group;
use Illuminate\Support\Facades\View;

class ReportingViewTest extends TestCase
{
    /**
     * Test that the complete reporting view displays correctly.
     *
     * @return void
     */
    #[Test]
    #[Group('reporting')]
    public function la_vue_reporting_complet_saffiche_correctement(): void
    {
        $report = [
            [
                'niveau' => 'L1',
                'progression_niveau' => 50,
                'semestres' => [
                    [
                        'semestre' => 'Semestre 1',
                        'progression_semestre' => 50,
                        'ues' => [
                            [
                                'module' => 'Mathématiques',
                                'cours' => [
                                    [
                                        'intitule' => 'Algèbre',
                                        'heure_total' => 40,
                                        'heure_suivie' => 20,
                                        'heure_restante' => 20,
                                        'progression' => 50,
                                        'statut' => 'En cours',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];

        $renderedView = View::make('reporting.suivi_cours', ['report' => $report])->render();

        // ADD THIS LINE TEMPORARILY:
        //dd($renderedView); // <-- DUMP THE VIEW CONTENT HERE

        $this->assertStringContainsString('L1', $renderedView);
        $this->assertStringContainsString('Semestre 1', $renderedView);
        $this->assertStringContainsString('Mathématiques', $renderedView);
        $this->assertStringContainsString('Algèbre', $renderedView);
        $this->assertStringContainsString('40', $renderedView);
        $this->assertStringContainsString('20', $renderedView);
        $this->assertStringContainsString('50%', $renderedView);
        $this->assertStringContainsString('En cours', $renderedView);
    }
}