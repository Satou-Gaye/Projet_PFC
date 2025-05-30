<?php

namespace App\Http\Controllers;

use App\Models\Semestre;
use App\Models\Niveau;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreSemestreRequest;
use App\Http\Requests\UpdateSemestreRequest;

class SemestreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $semestre = Semestre::all();  
        return view('semestres.index', 
        compact('semestre'));
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
    public function store(StoreSemestreRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Semestre $semestre)
    {
         $partie = Semestre:: find($semestre);
         return view('Semestres.show',compact('semestre'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Semestre $semestre)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSemestreRequest $request, Semestre $semestre)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Semestre $semestre)
    {
        //
    }


    Public function suiviSemestre(Semestre $semestre, $semaineEcoulee ){
        if($semaineEcoulee> $semestre->nbSemaines){
            print("Les semaines de ce semaine "+$semestre->nom_semestre+" est depassees.");
            $semaineEcoulee = $semestre->nbSemaines;
        }

        $semaineRestante = max(0,$semestre->nbSemaines - $semaineEcoulee);
        $pourcentage = ($semestre->nbnbSemaines >0)? ($semaineEcoulee / $semestre->nbSemaines) * 100 : 0;

        return $pourcentage;
    }


   

    

    public function analyse()
    {
        $semestres = Semestre::with('niveau')->get();

        // Préparer les données pour Highcharts
        $semestresChart = $semestres->map(function ($s) {
            return [
                'name' => $s->nom ?? 'Semestre ' . $s->id,
                'y' => $s->nbSemaine,
                'color' => $s->nbSemaine <= 8 ? '#FFC0CB' : '#7CB5EC' // rose ou bleu
            ];
        });

        return view('semestre.analyse', [
            'semestres' => $semestres,
            'semestresChart' => $semestresChart
        ]);
    }



}
 