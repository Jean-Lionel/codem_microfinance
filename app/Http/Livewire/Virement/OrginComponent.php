<?php

namespace App\Http\Livewire\Virement;

use App\Models\Compte;
use Livewire\Component;

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
        $this->inputs = ['email' => ''];
       
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
        $msg = "Bonjour de compteName";
        
        // Check if compte orgin contain this Montant
        // Validate exists compte
        // Get User

        $this->errorMessage = $msg;
    }

    
}
