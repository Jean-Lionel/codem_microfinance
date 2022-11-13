<div>
    {{-- Care about people's approval and you will be their prisoner. --}}

    <div class="form-group">
        <label for="">Numéro de compte d'orgine</label>
        <input type="text" wire:model="compteName"
        wire:keydown.enter="searchAcount"
         class="form-control form-control-sm">
        <div class="text-right">
            <button class="btn btn-sm btn-primary" wire:click="searchAcount">Rechercher</button>
        </div>
    </div>

    <div>
       @if ($compte)
           {{-- expr --}}
           <div class="card">
            <div class="card-header">
                <h5 class="card-title text-center">INFORMATION DU COMPTE D'ORGINE</h5>
                <div class="d-flex justify-content-between">
                    <p>Numéro de compte :</p>
                    <h5>{{$compte->name}}</h5>
                </div>
                <div class="d-flex justify-content-between">
                    <p>Nom et Prénom :</p>
                    <h5>{{$compte->client->fullName}}</h5>
                </div>
                <div class="d-flex justify-content-between">
                    <p>CNI :</p>
                    <h5>{{$compte->client->cni}}</h5>
                </div>
                <div class="d-flex justify-content-between">
                    <p>DATE DE NAISSANCE :</p>
                    <h5>{{$compte->client->date_naissance}}</h5>
                </div>
                <div class="d-flex justify-content-between">
                    <p>Solde :</p>
                    <h5>{{numberFormat($compte->montant)}} #FBU</h5>
                </div>

                <div>
                    <button>Valider</button>
                </div>
                <div>
                    <img src="{{asset('img/client_images'.$compte->client->image)}}" alt="">
                </div>
                
            </div>
        </div>
       @endif
        
    </div>
</div>
