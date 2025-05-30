<?php

namespace App\Http\Controllers;

use App\Models\Pivot;
use App\Http\Requests\StorePivotRequest;
use App\Http\Requests\UpdatePivotRequest;

class PivotController extends Controller
{
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
    public function store(StorePivotRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Pivot $pivots)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pivot $pivots)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePivotsRequest $request, Pivot $pivots)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pivot $pivots)
    {
        //
    }
}
