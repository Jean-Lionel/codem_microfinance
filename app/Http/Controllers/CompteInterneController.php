<?php

namespace App\Http\Controllers;

use App\Models\CompteInterne;
use App\Http\Requests\StoreCompteInterneRequest;
use App\Http\Requests\UpdateCompteInterneRequest;

class CompteInterneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCompteInterneRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompteInterneRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CompteInterne  $compteInterne
     * @return \Illuminate\Http\Response
     */
    public function show(CompteInterne $compteInterne)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CompteInterne  $compteInterne
     * @return \Illuminate\Http\Response
     */
    public function edit(CompteInterne $compteInterne)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCompteInterneRequest  $request
     * @param  \App\Models\CompteInterne  $compteInterne
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompteInterneRequest $request, CompteInterne $compteInterne)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CompteInterne  $compteInterne
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompteInterne $compteInterne)
    {
        //
    }
}
