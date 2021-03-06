@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-md-8">
		<b>Liste des clients</b>	
	</div>
	<div class="col-md-4 col-sm-6">
		<form action="" class="navbar-form navbar-left">
			<div class="input-group row custom-search-form">

				<input type="text" id="search" class="form-control col-md-8 " name="search" placeholder="Search..." value="{{$search}}" >
				
				<button class="btn btn-default-sm" type="submit">
					<i class="fa fa-search"></i>
				</button>


			</div>
		</form>
	</div>
</div>



<a href="{{ route('clients.create')}}" class="btn btn-info">Ajouter un client</a>

@if($clients)

<table class="table table-sm table-bordered table-responsive-sm table-striped table-inverse table-hover">
	<thead>
		<tr>
			<th>No</th>
			<th>@sortablelink('nom','Nom')</th>
			<th>@sortablelink('prenom','Prénom') </th>
			<th>Compte</th>
			<th>@sortablelink('cni','CNI')</th> 
			<th>@sortablelink('antenne','Antenne')</th>
			<th>@sortablelink('date_naissance','Date de naissance')</th>
			<th>@sortablelink('created_at','created at')</th>
			
			<th>Action</th>
		</tr>
	</thead>
	<tbody>

		@foreach($clients as $key=> $client)
		<tr>
			<td>{{$key + 1}}</td>
			<td>{{ $client->nom}}</td>
			<td>{{ $client->prenom}}</td>
			
			<td class="text-left">
			
					@foreach ($client->comptes as $compte)
					<span>{{$compte->name  }}</span>
					@endforeach
				
			</td>
			<td class="">{{ $client->cni}}</td>
			<td>{{ $client->antenne}}</td>
			<td>{{ dateFormat($client->date_naissance)}}</td>
			<td>{{dateFormat($client->created_at)}}</td>
			<td>
				<a href="{{ route('clients.show',$client) }}" class="btn btn-outline-info btn-sm">Afficher</a>
				<a href="{{ route('clients.edit',$client) }}" class="btn btn-outline-dark btn-sm">Modifier</a>

				@can('is-admin')

				<form class="form-delete" action="{{ route('clients.destroy' , $client) }}" style="display: inline;" method="POST">
					{{ csrf_field() }}
					{{ method_field('DELETE') }}
					<button class="btn btn-outline-danger btn-sm delete_client">Supprimer</button>
				</form>

				@endcan


			</td>
		</tr>

		@endforeach
	</tbody>
</table>

{{ $clients->links()}}


@endif



@endsection


@section('javascript')

<script>

	// let button = document.querySelector('.delete_client')

	// button.on('click', function(e){

	// 	// e.preventDefault()
	// 	// console.log("Je suis cool");

	// });


	jQuery(document).ready(function($) {


		$('.delete_client').on('click',  function(event) {
			 event.preventDefault();
			// console.log("je suis cool");

			let form = $(this).parent()
			//console.log(form);


			swal.fire({
				title: "Vous êtes sûr",
				text: "Une fois le client est supprimé ça sera difficile de le recuperer",
				type: "warning",
				showCancelButton: true,
				confirmButtonColor: '#DD6B55',
				confirmButtonText: 'Oui, Je suis sûr',
				cancelButtonText: "Non , Annuler",
				closeOnConfirm: false,
				closeOnCancel: false
			}).then(function(isConfirm){
				
				if(isConfirm.value){

					form.submit();
				}
			})
			});

	})

	
</script>

@stop