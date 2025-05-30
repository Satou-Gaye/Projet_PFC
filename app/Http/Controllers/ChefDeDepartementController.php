<?php

namespace App\Http\Controllers;

use App\Models\Chef_de_departement;
use App\Http\Requests\StoreChef_de_departementRequest;
use App\Http\Requests\UpdateChef_de_departementRequest;

class ChefDeDepartementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard2');
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
    public function store(StoreChef_de_departementRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Chef_de_departement $chef_de_departements)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Chef_de_departement $chef_de_departements)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateChef_de_departementRequest $request, Chef_de_departement $chef_de_departements)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Chef_de_departement $chef_de_departements)
    {
        //
    }
}
