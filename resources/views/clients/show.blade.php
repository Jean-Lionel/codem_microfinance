@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-md-6">
		<div class="card" style="width: 40rem;">
			<div class="card-header">
				<h1 class="text-center"> Information complet</h1>
			</div>
			<ul class="list-group list-group-flush">
				<li class="list-group-item">Nom : <b>{{ $client->nom}} </b></li>
				<li class="list-group-item">Prenom : <b>{{ $client->prenom}} </b></li>
				<li class="list-group-item">Carté d'indentité National : <b>{{ $client->cni}} </b></li>
				<li class="list-group-item">Date de naissance : <b>{{ $client->date_naissance}} </b></li>

			</ul>
		</div>
		
	</div>

	<div class="col-md-6">
		<div class="card">
			<div class="card-header">
				<h1>Information pour ces Comptes</h1>
			</div>

			@foreach($client->comptes as $compte)

			

			<ul class="list-group list-group-flush">
				<li class="list-group-item"><b>COMPTE NO : </b>  {{ $compte->name }} </li>
				<li class="list-group-item"><b>Montant   :</b> <h5>{{ $compte->montant }} FBU</h5></li>
				<li class="list-group-item"></li>
				
			</ul>

			@endforeach


		</div>
	</div>
</div>




@endsection