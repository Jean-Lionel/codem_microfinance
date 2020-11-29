<?php

namespace App\Http\Controllers;

use App\Models\ComptePlacement;
use App\Models\PlacementClient;
use Illuminate\Http\Request;

class ComptePlacementController extends Controller
{
    public function getClientCompteName()
    {
        $compte_name = \Request::get('compte_name');

        $compte = ComptePlacement::where('name','like','%'.$compte_name.'%')->first();

        if(!$compte){
            return response()->json(['error'=>'Numero invalide']);
        }

        $client = PlacementClient::whereId($compte->placement_client_id)->first();
        
        
        return ['compte'=>$compte,'client' =>$client];
    
    }

}
