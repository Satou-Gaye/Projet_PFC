<?php

namespace App\Http\Controllers;

use App\Models\EC;
use App\Http\Requests\StoreEcsRequest;
use App\Http\Requests\UpdateEcsRequest;
use App\Models\Niveau;

class ECController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ecs = EC::all();  
        return view('ecs.index', 
        compact('ec'));  // -> resources/views/Ecs/index.blade.php   
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEcsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(EC $ec)
    {
         $cours = EC:: find($ec);
         return view('show',compact('ec'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EC $ec)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEcsRequest $request, EC $ec)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(EC $ec)
    {
        //
    }

    public function dateDemarrage($codeEC)
{
    $ec = Ec::where('codeEC', $codeEC)->firstOrFail();

    if ($ec->date_debut) {
        return response()->json([
            'ec' => $ec->intitule,
            'date_demarrage' => $ec->date_debut,
        ]);
    } else {
        return response()->json([
            'ec' => $ec->intitule,
            'message' => 'Date de démarrage non définie.',
        ]);
    }
}



    

    public function suiviTousCoursParModule():array
    {
        $niveaux = Niveau::with('semestres.ues.ecs')->get();
        $resultats = [];
        $statut->default('Pas encore commencer');

        foreach ($niveaux as $niveau) {
            $semestresData = [];

            foreach ($niveau->semestres as $semestre) {
                $uesData = [];

                foreach ($semestre->ues as $ue) {
                    $ecsData = [];

                    foreach ($ue->ecs as $ec) {
                        $heureRestante = max(0, $ec->nbHeureTotal - $ec->nbHeureSuivi);
                        $pourcentage = ($ec->nbHeureTotal > 0)
                            ? ($ec->nbHeureSuivi / $ec->nbHeureTotal) * 100
                            : 0;

                        $ecsData[] = [
                            'Cours' => $ec->intitule,
                            'Heure_total' => $ec->nbHeureTotal,
                            'Heure_suivie' => $ec->nbHeureSuivi,
                            'Heure_restante' => $heureRestante,
                            'Progression' => round($pourcentage, 2),
                            'Statut' => ($ec->nbHeureSuivi >= $ec->nbHeureTotal) ? 'Terminé' : 'En cours',
                        ];
                    }

                    $uesData[] = [
                        'ue' => $ue->codeUE,
                        'cours' => $ecsData,
                    ];
                }

                $semestresData[] = [
                    'semestre' => $semestre->nom_semestre,
                    'ues' => $uesData,
                ];
            }

            $resultats[] = [
                'niveau' => $niveau->nom_niveau,
                'semestres' => $semestresData,
            ];
        }

        return view('Suivi/suivi ',['resultats' => $resultats]);
    }     



   

    public function reportingCompletSuiviCours():View
    {
        $niveaux = Niveau::with('semestres.ues.ecs')->get();
        $report = [];

        foreach ($niveaux as $niveau) {
            $semestresData = [];
            $totalHeuresNiveau = 0;
            $totalHeuresSuiviesNiveau = 0;
            $statut->default('Pas encore commencer');

            foreach ($niveau->semestres as $semestre) {
                $uesData = [];
                $totalHeuresSemestre = 0;
                $totalHeuresSuiviesSemestre = 0;

                foreach ($semestre->ues as $ue) {
                    $coursData = [];

                    foreach ($ue->ecs as $ec) {
                        $heureTotal = $ec->nbHeureTotal;
                        $heureSuivie = $ec->nbHeureSuivi;
                        $heureRestante = max(0, $heureTotal - $heureSuivie);
                        $progression = ($heureTotal > 0)
                            ? round(($heureSuivie / $heureTotal) * 100, 2)
                            : 0;
                        $statut = ($heureSuivie >= $heureTotal) ? 'Terminé' : 'En cours';

                        // Cumul
                        $totalHeuresSemestre += $heureTotal;
                        $totalHeuresSuiviesSemestre += $heureSuivie;

                        $coursData[] = [
                            'intitule' => $ec->intitule,
                            'heure_total' => $heureTotal,
                            'heure_suivie' => $heureSuivie,
                            'heure_restante' => $heureRestante,
                            'progression' => $progression,
                            'statut' => $statut,
                        ];
                    }

                    $uesData[] = [
                        'module' => $ue->nom,
                        'cours' => $coursData,
                    ];
                }

                // Progression semestre
                $progressionSemestre = ($totalHeuresSemestre > 0)
                    ? round(($totalHeuresSuiviesSemestre / $totalHeuresSemestre) * 100, 2)
                    : 0;

                // Ajouter au niveau
                $totalHeuresNiveau += $totalHeuresSemestre;
                $totalHeuresSuiviesNiveau += $totalHeuresSuiviesSemestre;

                $semestresData[] = [
                    'semestre' => $semestre->nom_semestre,
                    'progression_semestre' => $progressionSemestre,
                    'ues' => $uesData,
                ];
            }

            // Progression niveau
            $progressionNiveau = ($totalHeuresNiveau > 0)
                ? round(($totalHeuresSuiviesNiveau / $totalHeuresNiveau) * 100, 2)
                : 0;

            $report[] = [
                'niveau' => $niveau->nom_niveau,
                'progression_niveau' => $progressionNiveau ?? 0,
                'semestres' => $semestresData,
            ];
        }

        return view('Reporting/suivi_cours', ['report' => $report]);
    }



      

    }
