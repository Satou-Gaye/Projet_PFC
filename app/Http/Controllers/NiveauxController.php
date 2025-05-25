<?php

namespace App\Http\Controllers;

use App\Models\Niveaux;
use App\Http\Requests\StoreNiveauRequest;
use App\Http\Requests\UpdateNiveauRequest;

class NiveauxController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $niveau = Niveaux::all();  
        return view('niveaux.index', 
        compact('niveau'));
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
    public function store(StoreNiveauRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Niveaux $niveau)
    {
         $etat = Ec:: find($niveau);
         return view('niveaux.show',compact('niveau'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Niveaux $niveau)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateNiveauRequest $request, Niveaux $niveau)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Niveaux $niveau)
    {
        //
    }
}
