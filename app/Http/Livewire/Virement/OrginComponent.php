<?php

namespace App\Http\Livewire\Virement;

use App\Models\Compte;
use Livewire\Component;

class OrginComponent extends Component
{
    public $compteName;
    public $compte;

    public function render()
    {
        return view('livewire.virement.orgin-component');
    }

    public function searchAcount(){

        $c = Compte::where('name', 'like', '%'.$this->compteName)->first();
        $this->compte = $c;
    }
}
