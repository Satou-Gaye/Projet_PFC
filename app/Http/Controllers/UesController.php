<?php

namespace App\Http\Controllers;

use App\Models\Ues;
use App\Http\Requests\StoreUeRequest;
use App\Http\Requests\UpdateUeRequest;

class UesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ue = Ues::all();  
        return view('uesindex', 
        compact('ue'));
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
    public function store(StoreUeRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Ues $ue)
    {
         $module = Ues:: find($ue);
         return view('ues.show',compact('ue'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ues $ue)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUeRequest $request, Ues $ue)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ues $ue)
    {
        //
    }

    
}
