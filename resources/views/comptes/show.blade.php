@extends('layouts.app')

@section('content')


	{{--


    'cni',
    'date_naissance',
    'date_ouverture',
    '',
    'nom_mandataire_1',
    'nom_mandataire_2',
    'nationalite',
    'date_delivrance',
    'etat_civil',
    'nom_conjoint',
    'profession',
    '',
    'lieu_activite',
    'commune',
    'quartier',
    'rue',
    'address_no',
    'boite_postal',
    'telephone',
    'signateur_1_nom_prenom',
    'signateur_1_cni',
    'signateur_1_tel',
    'signateur_2_nom_prenom',
    'signateur_2_cni',
    'signateur_2_tel',
    'signateur_3_nom_prenom',
    'signateur_3_cni',
    'signateur_3_tel'



	 --}}




<div class="row">
	<div class="col-md-6">
		<div class="card" style="width: 40rem;">
			<div class="card-header">
				<h1 class="text-center"> Information complet</h1>
			</div>
			<ul class="list-group list-group-flush">
				<li class="list-group-item">Nom et prénom :<b>{{ $client->nom}}  {{ $client->prenom}} </b></li>
				<li class="list-group-item">Antenne :<b>{{ $client->antanne}} </b></li>

				<li class="list-group-item">Nom de l'Association :<b>{{ $client->nom_association}} </b></li>
				<li class="list-group-item">Nationalité :<b>{{ $client->nationalite}} </b></li>
				<li class="list-group-item">CNI :<b>{{ $client->cni}} </b></li>
				<li class="list-group-item">Date et Lieu de délivrance :<b>{{ $client->date_delivrance}} </b></li>	
				<li class="list-group-item">Lieu et Date de naissance : <b>{{ $client->date_naissance}} </b></li>
				<li class="list-group-item">Etat civil : <b>{{ $client->etat_civil}} </b>

					@if ($client->nom_conjoint != 'Null')
						 | Nom du conjoint : <b>{{ $client->nom_conjoint }} </b>
					@endif


				</li>
				
				<li class="list-group-item">Profession : <b>{{ $client->profession}} </b>
					<ul>
						<li>
							Employeur : <b>{{ $client->nom_employeur }}</b> 
						</li>
						<li>
							Employeur : <b>{{ $client->lieu_activite }}</b> 
						</li>
					</ul>
				</li>

				<li class="list-group-item"> <b>{{ 'Addresse'}} </b>

					<table class="table table-hover table-bordered">
						<thead>
							<tr>
								<th>Commune</th>
								<th>Quartier</th>
								<th>Rue</th>
								<th>N°</th>
								<th>B.P</th>
								<th>Téléphone</th>
							</tr>
							
						</thead>
						<tbody>
							<tr>
								<td>{{ $client->commune}}</td>
								<td>{{ $client->quartier}}</td>
								<td>{{ $client->rue}}</td>
								<td>{{ $client->address_no}}</td>
								<td>{{ $client->boite_postal}}</td>
								<td>{{ $client->telephone}}</td>
							</tr>
							
						</tbody>
						
					</table>
					
				</li>

			</ul>
		</div>
		
	</div>

	<div class="col-md-6">
		<div class="card">
			<div class="card-header">
				<h1>Information pour ces Comptes</h1>
			</div>

			@if (count($client->comptes) <=0)
				<div class="row">
					<div class="col-md-8">
						
					</div>
					<div class="col-md-4">
						<a href="{{ route('comptes.create') }}" class="btn btn-sm btn-primary text-right"> <i class="fa fab-plus"></i> Attribuer un compter</a>	
					</div>
				</div>
				
			@endif

			@foreach($client->comptes as $compte)

			

			<ul class="list-group list-group-flush">
				<li class="list-group-item"><b>COMPTE NO : </b>  {{ $compte->name }} </li>
				<li class="list-group-item"><b>Montant   :</b> <h5>{{ $compte->montant }} FBU</h5></li>
				<li class="list-group-item"></li>
				
			</ul>

			@endforeach

			<h5 class="text-center text-info">Noms et prénoms de signataires</h5>

			<ul class="list-group list-group-flush">
				<li class="list-group-item">
					<div class="row">
						<div class="col-md-4">
							{{ $client->signateur_1_nom_prenom}}
						</div>
						<div class="col-md-4">
							CNI N° {{ $client->signateur_1_cni}}
						</div>
						<div class="col-md-4">
							Tél {{ $client->signateur_1_tel}}
						</div>
					</div>
				</li>

				<li class="list-group-item">
					<div class="row">
						<div class="col-md-4">
							{{ $client->signateur_2_nom_prenom}}
						</div>
						<div class="col-md-4">
							CNI N° {{ $client->signateur_2_cni}}
						</div>
						<div class="col-md-4">
							Tél {{ $client->signateur_2_tel}}
						</div>
					</div>
				</li>

				<li class="list-group-item">
					<div class="row">
						<div class="col-md-4">
							{{ $client->signateur_3_nom_prenom}}
						</div>
						<div class="col-md-4">
							CNI N° {{ $client->signateur_3_cni}}
						</div>
						<div class="col-md-4">
							Tél {{ $client->signateur_3_tel}}
						</div>
					</div>
				</li>
				
				
			</ul>


		</div>
	</div>
</div>




@endsection