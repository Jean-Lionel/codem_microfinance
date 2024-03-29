<?php

namespace App\Models;

use App\Models\Compte;
use App\Models\TenueCompte;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\ComptePrincipalController;
use App\Http\Controllers\ComptePrincipalOperationController;

class TenuCompteurWatch extends Model
{
    //
    protected $guarded = [];

    // ENLEVE LE TENU DE COMPTE 
    // ENREGISTRE LES INFORMATIONS
    // DESCATIVE L'OPERATION POUR CE MOIS
    // 
    // BOOL REVOIE TRUE SI CA EXISSTE FAUX 
    
    public static function isAllReadyTaken() 
    {

        $created_at = TenuCompteurWatch::latest()->first()->created_at ?? null;
        $created_at =  $created_at ? $created_at->format('Y-m') : null;
        if( str_contains( $created_at, now()->format('Y-m') )){
            return true;
        }else{
            return false;
        }
    }

    public static function tenueCompteMensuel(){
        // Pay More attention for this code 12/7/2022 a Rutovu chez Thierry
        // 
        if(!self::isAllReadyTaken()){
            $comptes_soldes = Compte::where('montant', '<', TENU_COMPTE_MENSUELLE )->count();
            $comptes = Compte::where('montant', '>=', TENU_COMPTE_MENSUELLE)->get();

            try {
                DB::beginTransaction();
                $timeWach = time(); 
                $tenuCompte = [];
                foreach($comptes as $compte){
                    $temp = TenueCompte::where('compte_name', $compte->name)
                    ->where('created_at', 'LIKE', now()->format('Y-m').'%')->first();

                    if(!$temp){
                     $compte->montant -= TENU_COMPTE_MENSUELLE;
                     $compte->save();
                     $tenuCompte[] = [
                        'compte_name' => $compte->name,
                        'montant' => TENU_COMPTE_MENSUELLE,
                        'tenu_compteur_watche_id' => $timeWach,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];

                }

            }
            $x_element = array_chunk($tenuCompte, 10000);
            foreach ($x_element as  $value) {
             TenueCompte::insert($value);
         }
         
         $montant_total = count($tenuCompte) *  TENU_COMPTE_MENSUELLE;
         ComptePrincipalOperationController::storeOperation($montant_total,'tenue_compte',"COMPTE PRINCIPAL");
         ComptePrincipalController::store_info($montant_total, 'ADD');

         TenuCompteurWatch::create([
            "montant" => $montant_total,
            "status"  => "SUCCESS",
            "comptes_error" => $comptes_soldes ,
            "comptes_success" => $comptes->count(),
            "tenu_compteur_watche_id" => $timeWach
        ]);

         DB::commit();

     } catch (\Exception $e) {
        
        DB::rollback();
        dump($e->getMessage());
    }

        //dd("Finish");

}else{

            //dump("Orleady Taken ");

}

}



    // public static function takeTenuCompte(){
    //     if(!self::isAllReadyTaken()){
    //         //$all_compte = Compte::where('montant', '>=', TENU_COMPTE_MENSUELLE )->get();
    //         $all_compte = Compte::all();
    //         //DESCRIPTION
    //         $error_compte = Compte::where('montant', '<', TENU_COMPTE_MENSUELLE )->get()->toJson();

    //         $montant_total = $all_compte->count() * TENU_COMPTE_MENSUELLE; 
    //         //MONTANT TOTAL DU TENU DE COMPTE

    //        try {
    //         DB::beginTransaction();
    //         foreach ($all_compte as $key => $compte) {
    //             // code...
    //             // ENLEVE LE MONTANT SUR CHAQUE COMPTE
    //             // ENREGISTRE DANS LES TENUS DE COMPTE
    //             $compte->montant -= TENU_COMPTE_MENSUELLE;
    //             $compte->save();
    //             TenueCompte::create([
    //             'compte_name' =>  $compte->name,
    //             'montant' => TENU_COMPTE_MENSUELLE,
    //            ]);
    //         }

    //         ComptePrincipalOperationController::storeOperation($montant_total,'tenue_compte',"COMPTE PRINCIPAL");
    //         ComptePrincipalController::store_info($montant_total, 'ADD');

    //         if(self::isAllReadyTaken()){
    //             throw new \Exception("Opération a été déjà realisé par quelque d'autre", 1);

    //         }
    //         TenuCompteurWatch::create([
    //                 "montant" => $montant_total,
    //                 "status"  => "SUCCESS",
    //                 "comptes_error" => $error_compte ,
    //                 "comptes_success" => $all_compte->toJson(),
    //         ]);
    //         DB::commit();   
    //         //echo "REUSSI"; 
    //        } catch (\Exception $e) {
    //          DB::rollback();  
    //          dd( $e);
    //        }

    //     }else{

    //     }
    // }

}
