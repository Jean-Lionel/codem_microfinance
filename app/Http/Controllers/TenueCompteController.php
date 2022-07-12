<?php

namespace App\Http\Controllers;

use App\Models\Compte;
use App\Models\TenueCompte;
use Illuminate\Http\Request;
use App\Models\TenuCompteurWatch;

class TenueCompteController extends Controller
{


    //paiment d'une seule compte return True si tout est passe est 
    //Le nom si pas reussi 

	public function index(){

		$compte_all = Compte::all();

		$result = TenueCompte::allAccountPaiment($compte_all);

		$result = TenueCompte::montantMensuelle();

		return $result;
	}

    //LA function retourner le montant mensuelle de tout les employes et retourner les comptes de le montant est indufisant

	public function tenueMensuelle(){
		$response = "";
		if(!TenuCompteurWatch::isAllReadyTaken()){
			TenuCompteurWatch::tenueCompteMensuel();
		}else{
			$response = " Déjà réalisée";
		}

		$tenus_comptes = TenuCompteurWatch::latest()->paginate(10);

		return view('rapports.tenucomptes',
			[
				'tenus_comptes' => $tenus_comptes, 
				'response' => $response, 
			]

		);

	}



}


