<?php

namespace App\Http\Controllers;

use App\Models\Assistante_departement;
use App\Http\Requests\StoreAssistante_departementRequest;
use App\Http\Requests\UpdateAssistante_departementRequest;

	class AssistanteDepartementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard3');
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
    public function store(StoreAssistante_departementRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Assistante_departement $assistante_departements)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Assistante_departement $assistante_departements)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAssistante_departementRequest $request, Assistante_departement $assistante_departements)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Assistante_departement $assistante_departements)
    {
        //
    }
}
