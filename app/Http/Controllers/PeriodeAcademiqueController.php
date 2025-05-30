<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Periode_academique;
use App\Services\PeriodeAcademiqueService;
use App\Http\Requests\StorePeriodeAcademiqueRequest;
use App\Http\Requests\UpdatePeriodeAcademiqueRequest;

class PeriodeAcademiqueController extends Controller
{
    protected $academicPeriodeService;

    public function __construct(PeriodeAcademiqueService $PeriodeAcademiqueService)
    {
        $this->PeriodeAcademiqueService = $PeriodeAcademiqueeService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StorePeriodeAcademiqueRequest $request)
    {
          $data = $request->validate([
            
            'date_debut'        => 'required|date',
            'semaine'             => 'required|integer|min:1',
            'couleur'             => 'nullable|string',
            'type'              => 'required|in:semestre,examen,date_morte,vacances',
            'niveau_id' => 'required|exists:academic_levels,id',
            'annee_academique_id'  => 'required|exists:academic_years,id',
        ]);
         // La création déclenche l'observer qui applique les ajustements métier.
        $PeriodeAcademique = $this->PeriodeAcademiqueService->creatingAcademicPeriode($data);

                return redirect()->route('academic-periodes.index')
                         ->with('success', 'Période créée avec succès. Date de fin calculée : ' . $PeriodeAcademique->date_fin);
    }

    /**
     * Display the specified resource.
     */
    public function show(PeriodeAcademique $PeriodeAcademique)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PeriodeAcademique $PeriodeAcademique)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePeriodeAcademiqueRequest $request, PeriodeAcademique $PeriodeAcademique)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PeriodeAcademique $PeriodeAcademique)
    {
        //
    }
}
