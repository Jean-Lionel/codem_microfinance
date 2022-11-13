<?php

namespace App\Http\Livewire\Virement;

use App\Models\Compte;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class OrginComponent extends Component
{
    public $compteName;
    public $compte;
    public $montant;
    public $validate=false;
    public $destinationCompteName;
    public $destinationCompte;
    public $validateCompteDestination;
    public $errorMessage;


    public function mount()
    {


    }

    public function render()
    {
        return view('livewire.virement.orgin-component');
    }

    public function searchAcount(){
        $this->compte = Compte::getCompte($this->compteName);
        $this->validate = false;
    }

    public function validerInformation(){
        $this->validate = true;
    }

    public function validateCompteDestinationInformation(){
        $this->validateCompteDestination = true;
    }

    public function selectAcount(){

        $this->destinationCompte = Compte::getCompte($this->destinationCompteName);
        $this->validateCompteDestination = false;
    }

    public function saveOperation(){
        $msg = "";
        
        // Check if compte orgin contain this Montant
        // Validate exists compte
        // Get User
        
        $montant = floatval($this->montant);
        if($montant <=0){
           $msg =  "Le montant doit être supérieur à 0";
         }
        if(!$this->destinationCompte->name) {
           $msg = "Vérfier vos numéro de compte du bénéficiaire";
        }
        if(!$this->compte->name) {
         $msg = "Vérfier vos numéro de compte du debuteur";
         }
        if($this->compte->name == $this->destinationCompte->name){
        $msg = "Opération impossible sur le même compte " . $this->destinationCompte->name;
        }

        if($this->compte->montant < $montant){
        $msg = "Solde insufisant sur le compte ". $this->compte->name;
        }

        $user = auth()->user();


        if($user->roles()->count() == 0){
            $msg = "Vous n'avez pas d'autorisation ";
        }

        if($msg != ""){
          try {
            DB::begintransaction();
             $this->compte->montant -= $montant;
             $this->destinationCompte->montant += $montant;


             $this->compte->save();
             $this->destinationCompte->save();
            DB::commit();
              
          } catch (\Exception $e) {
              $msg = $e->getMessage();
              DB::rollback();
          }

        }

        $this->errorMessage = $msg;

}


}
