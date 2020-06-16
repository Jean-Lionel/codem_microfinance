<?php

namespace App\Http\Controllers;

use App\Models\Placement;
use App\Http\Requests\FormPlacementRequest;

use Illuminate\Http\Request;

class PlacementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $placements = Placement::sortable()->paginate(20);

        return view('placements.index',compact('placements'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $placement = new Placement;

        return view('placements.create', compact('placement'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FormPlacementRequest $request)
    {
        $interet_total = ($request->interet_total * $request->montant) / 100;
        $place_interet = $request->montant + $interet_total;
        $interet_moi = $interet_total / $request->nbre_moi;

        Placement::create([
            'montant' => $request->montant,
            'compte_name' => $request->compte_name,
            'nbre_moi' => $request->nbre_moi,
            'interet_total' => $interet_total,
            'interet_Moi' => $interet_moi,
            'place_interet' => $place_interet,
            'date_placement' => $request->date_placement
            ]);

        return $this->index();
      
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Placement  $placement
     * @return \Illuminate\Http\Response
     */
    public function show(Placement $placement)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Placement  $placement
     * @return \Illuminate\Http\Response
     */
    public function edit(Placement $placement)
    {
       return view('placements.edit',compact('placement'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Placement  $placement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Placement $placement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Placement  $placement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Placement $placement)
    {
        //
    }
}