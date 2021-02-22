<div>
    {{-- Success is as dangerous as failure.

    	compte_name
type_operation
montant



     --}}


       @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session()->has('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

   	<div class="row mt-5">
   		<div class="col-md-6">
	   		<form action="" wire:submit.prevent="saveOperation">
	   			<div class="row">
	   				<div class="form-group col-md-6">
		   				<label for="">COMPTE DU MEMBRE</label>
		   				<input wire:model="CompteName" type="text" class="form-control">
		   				@error('CompteName')
		   				<span class="text-danger">{{ $message }}</span>
		   				@enderror
	   			   </div>

	   			   <div class="form-group col-md-6">
		   				<label for="">TYPE D'OPERATION</label>
		   				<select wire:model="type_operation" id="" class="form-control">
		   					<option value="">Choisissez</option>
		   					<option value="RETRAIT">RETRAIT</option>
		   					<option value="VERSEMENT">VERSEMENT</option>
		   				</select>
		   				@error('type_operation')
		   				<span class="text-danger">{{ $message }}</span>
		   				@enderror
	   			   </div>

	   			   <div class="form-group col-md-6">
		   				<label for="">MONTANT</label>
		   				<input wire:model="montant"  type="text" class="form-control">
		   				@error('montant')
		   				<span class="text-danger">{{ $message }}</span>
		   				@enderror
	   			   </div>
	   			   <div class="form-group col-md-6">
		   				<label for="">⚓</label>
		   				<input type="submit" value="Enregistrer" class="form-control btn btn-primary">
	   			   </div>
	   			</div>
	   		</form>

   		</div>
   		<div class="col-md-5">

   			@if(isset($membre->first_name))
	   		<div class="card">
	   			<div class="card-header text-center">INFORMATION DU MEMBRE</div>

	   			<ul class="list-group">
	   				<li class="list-group-item d-flex justify-content-between">
	   					<span>NOM  ET PRENOM :</span> 
	   					<span>{{ $membre->first_name .' '. $membre->last_name }}</span></li>
	   				<li class="list-group-item d-flex justify-content-between">
	   					<span>TELEPHONE : </span>
	   					<span>{{ $membre->telephone}}</span>
	   				</li>
	   				<li class="list-group-item d-flex justify-content-between">
	   					<span>CNI :</span> 
	   					<span>{{ $membre->cni}}</span>
	   				</li>
	   				<li class="list-group-item d-flex justify-content-between">
	   					<span>ADDRESSE : </span>
	   					<span>{{ $membre->addresse}}</span>
	   				</li>
	   				<li class="list-group-item d-flex justify-content-between">
	   					<span>MONTANT: </span>
	   					<span>{{ number_format($membre->compte->montant) }} #FBU</span>
	   				</li>
	   				
	   			</ul>
	   		</div>

	   		@else
	   		<div class="badge-danger">
	   			<h3 class="text-center">NUMERO INVALIDE</h3>
	   			
	   		</div>

	   		@endif
   		</div>
   	</div>
</div>
