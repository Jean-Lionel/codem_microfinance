<?php

namespace App\Http\Livewire\Settings;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;

class Setting extends Component
{
    public $user;
    public $setPassword;
    public $last_password;
    public $new_password;
    public $confirm_password;
    public $showMessage;

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

    public function updatePassword(){
       
       if($this->new_password === $this->confirm_password){
        
        if (Hash::check($this->last_password, $this->user->password)) {
            $this->showMessage  = "Votre mot de passe a été bien modifié";
            $this->user->update(['password' => bcrypt($this->new_password)]);
            $this->setPassword  = false;
        }else{
            $this->showMessage  = "Votre ancien mot de passe n'est pas correctes";
        }
        
       }else{
        $this->showMessage = "Les deux mot de passe sont different";
       }
    }
}
