<?php

namespace App\Http\Livewire;

use App\Models\CaisseCaissier;
use App\Models\OperationCaisse;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CaisseCaissierLivewire extends Component
{
	public $user_id;
	public $montant;
	public $type_operation;
    public $showInputData;
    public $montantRemis;

	public $rules = [
		"user_id" => "required|exists:users,id",
		"montant" => "required|numeric|min:5000",
		// "type_operation" => "required",
	];
    public function render()
    {
    	$users = User::all();
        $caisse_caissiers = CaisseCaissier::all();
        return view('livewire.caisse-caissier-livewire',[
        	"users" => $users,
            "caisse_caissiers" => $caisse_caissiers,
        ]);
    }

    public function showInput($caisse){
        $this->showInputData = $caisse;
        $this->montantRemis = 0;
    }
    public function saveCaisseOperation(){
    	$this->validate($this->rules);
        try {
            DB::beginTransaction();
            $caisse = CaisseCaissier::where("user_id",$this->user_id)->first();
            // dump($this->user_id);
            // dd($caisse );
            //SI LE COMPTE N'EXISTE ON FAIT LA CREATION
            if(!$caisse){
              $caisse =   CaisseCaissier::create([
                "user_id" => $this->user_id,
                "montant" => 0,
                "agence_id" => 0
                ]);
            }
            $user = User::find($this->user_id);
            $caisse->montant += $this->montant;
            $caisse->agence_id = $user->agence_id;
            $caisse->save();

            OperationCaisse::create([
                "montant" =>$this->montant,
                "user_id" => $this->user_id,
                "type_operation" => "VIREMENT MATINAL"
            ]);
            $this->reset();
            DB::commit();
            
        } catch (\Exception $e) {
            dd($e->getMessage());
            DB::rollback();
            
        }
    	//dd("BONSOIR LE MILLIARDAIRE");
    }

    public function validerReception($id){

        //dd($id,$this->montantRemis);

        // if()

        $caisse = CaisseCaissier::find($id);
        try {
            DB::beginTransaction();
                OperationCaisse::create([
                    "montant" => ($this->montantRemis),
                    "montant_restant" => ($caisse->montant - $this->montantRemis) ,
                    "user_id" => $caisse->user_id,
                    "type_operation" => "RETOUR SOIR"
                ]);
                $caisse->montant = ($caisse->montant - $this->montantRemis);
                $caisse->save();
            DB::commit(); 
        } catch (\Exception $e) {
            dd($e->getMessage());
            DB::rollback();
            
        }
    }
}
