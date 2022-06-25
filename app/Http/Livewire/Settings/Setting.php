<?php

namespace App\Http\Livewire\Settings;

use Livewire\Component;

class Setting extends Component
{
    public $user;
    public $setPassword;

    public function mount(){
        $this->user = auth()->user();
    }

    public function render()
    {
        return view('livewire.settings.setting');
    }

    public function setNewPassword(){
        $this->setPassword = ! $this->setPassword ;
    }
}
