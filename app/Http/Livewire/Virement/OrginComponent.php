<?php

namespace App\Http\Livewire\Virement;

use App\Models\Compte;
use Livewire\Component;

class OrginComponent extends Component
{
    public $compteName;
    public $compte;
    public $validate=false;
    public $destinationCompte;


    public function mount()
    {
        $this->inputs = ['email' => ''];
       
    }

    public function render()
    {
        return view('livewire.virement.orgin-component');
    }

    public function searchAcount(){

        
        $this->compte = $c;
        $this->validate = false;
    }

    public function validerInformation(){
        $this->validate = true;
    }

    public function selectAcount(){

        dd($this->destinationCompte);
    }

    
}
