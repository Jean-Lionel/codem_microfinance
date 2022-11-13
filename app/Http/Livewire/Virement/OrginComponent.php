<?php

namespace App\Http\Livewire\Virement;

use App\Models\Compte;
use Livewire\Component;
use App\Models\Operation;
use App\Models\VirementHistory;
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
    public $motif;
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
   

    $piece_number = time();

    $debuteur = Operation::create([
        'compte_name' => $this->compte->name,
        'operer_par' => auth()->user()->name,
        'montant' => $montant,
        'type_operation' => "TRANSFERT PAR VIREMENT",
        'user_id' => auth()->user()->id,
        'cni' => "", 
        'motif' => $this->motif . " [ TRANSFERT PAR VIREMENT D'UNE SOMME DE (" .$montant." #Fbu ) PROVENANT DU COMPTE NUMERO ".$this->destinationCompte->name. " DE ".  $this->destinationCompte->client->fullName . " ]",
        'piece_number' => $piece_number
    ]);
    $recepteur = Operation::create([
        'compte_name' => $this->destinationCompte->name,
        'operer_par' => auth()->user()->name,
        'montant' => $montant,
        'type_operation' => "RECEPTION PAR VIREMENT",
        'user_id' => auth()->user()->id,
        'cni' => "", 
        'motif' => $this->motif . "[ RECEPTION PAR VIREMENT D'UNE SOMME DE (" .$montant." #Fbu ) PROVENANT DU COMPTE NUMERO ".$this->compte->name. " DE ".  $this->compte->client->fullName . " ]",
        'piece_number' => $piece_number
    ]);

    VirementHistory::create([
        'compte_debuteur' => $this->compte->name,
        'compte_beneficiary' => $this->destinationCompte->name,
        'montant' => $montant,
        'user_id' => auth()->user()->id,
        'motif' => $this->motif,
        'operation_debuteur_id' =>  $debuteur->id,
        'operation_recepteur_id' =>  $recepteur->id,
    ]);

    $this->compte->montant -= $montant;
    $this->destinationCompte->montant += $montant;
    $this->compte->save();
    $this->destinationCompte->save();
    DB::commit();

    $this->resetInput();

} catch (\Exception $e) {
  $msg = $e->getMessage();
  DB::rollback();
}

}

$this->errorMessage = $msg;

}


private function resetInput(){
    $this->destinationCompte = null;
    $this->validateCompteDestination = null;

}


}
