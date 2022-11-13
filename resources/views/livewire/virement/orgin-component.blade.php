<div class="row">
    {{-- Care about people's approval and you will be their prisoner. --}}

    <div class="col-md-4">
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
            <h5 class="card-title text-center">INFORMATION DU COMPTE DÉBITEUR</h5>
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
                <h5>{{dateFormat($compte->client->date_naissance)}}</h5>
            </div>   
            <div class="d-flex justify-content-between">
                <p>Téléphone :</p>
                <h5>{{$compte->client->telephone}}</h5>
            </div>
            <div class="d-flex justify-content-between">
                <p>Solde :</p>
                <h5>{{numberFormat($compte->montant)}} #FBU</h5>
            </div>

            <div>
                <button wire:click="validerInformation">Valider</button>
            </div>
            <div>
                <img src="{{asset('img/client_images'.$compte->client->image)}}" alt="">
            </div>

        </div>
    </div>
    @endif

</div>

</div>

<div class="col-md-8">
    @if ($validate)
    {{-- expr --}}
    <div class="d-flex justify-content-between">
        <p>Numéro de compte d'orgine :</p>
        <h5>{{$compte->name}}</h5>
        <h5>{{$compte->montant}} #FBU</h5>
    </div>

    <div>
        <table class="table tab-content">

            <tr>
                <th>Numéro de compte  </th>
                <td>
                   <input type="text" wire:model="destinationCompteName"
                   wire:keydown.enter="selectAcount" class="form-control form-control-sm">
               </td>
               <td> <button wire:click="selectAcount" class="btn btn-info btn-block btn-sm">Ok</button></td>

           </tr> 
           @if ($destinationCompte)
           {{-- expr --}}
           <tr>
               <th colspan="2" class="text-center">Information du compte bénéficiaire.</th>
           </tr>
           <tr>
            <th>Numéro de Compte</th>
            <td>{{$destinationCompte->name }}</td>
        </tr> 
        <tr>
            <th>Nom et prénom</th>
            <td>{{$destinationCompte->client->fullName }}</td>
        </tr>
        <tr>
           <th>CNI</th>
           <td>{{$destinationCompte->client->cni }}</td>
       </tr> 
       <tr>
           <th>Date de Naissance</th>
           <td>{{$destinationCompte->client->date_naissance }}</td>
       </tr>
       @if (!$validateCompteDestination)
       {{-- expr --}}
       <tr>
        <td><button wire:click="validateCompteDestinationInformation">Valider</button></td>
    </tr>
    @else

    @if ($errorMessage)
        {{-- expr --}}
        <p class="error  bg-danger  text-center text-white">{{$errorMessage}}</p>
    @endif

    <tr>
        <td>Motif</td>
        <td><input type="text" class="form-control form-control-sm" wire:model="motif"></td>
    </tr>
    <tr>
        <th>Montant</th>
        <td>
            <input type="number" wire:model="montant">
        </td>
        <td>
            <button wire:click="saveOperation">Virement</button>
        </td>
    </tr>
    @endif
    @endif



</table>
</div>
@endif
</div>

</div>


