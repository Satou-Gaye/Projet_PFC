<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AcademicPeriode;
use App\Services\AcademicPeriodeService;
use App\Http\Requests\StoreAcademicPeriodeRequest;
use App\Http\Requests\UpdateAcademicPeriodeRequest;

class AcademicPeriodeController extends Controller
{
    protected $academicPeriodeService;

    public function __construct(AcademicPeriodeService $academicPeriodeService)
    {
        $this->academicPeriodeService = $academicPeriodeService;
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
    public function store(StoreAcademicPeriodeRequest $request)
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
        $academicPeriode = $this->academicPeriodeService->creatingAcademicPeriode($data);

                return redirect()->route('academic-periodes.index')
                         ->with('success', 'Période créée avec succès. Date de fin calculée : ' . $academicPeriode->date_fin);
    }

    /**
     * Display the specified resource.
     */
    public function show(AcademicPeriode $academicPeriode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AcademicPeriode $academicPeriode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAcademicPeriodeRequest $request, AcademicPeriode $academicPeriode)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AcademicPeriode $academicPeriode)
    {
        //
    }
}
