@extends('layouts.app')

@section('content')
<h1>Listes des comptes disponible</h1>

<a href="{{ route('clients.index')}}" class="btn btn-info">Ajouter un Compte</a>

@if($comptes)

<table class="table table-bordered table-inverse table-responsive-sm table-hover">
	<thead>
		<tr>
			<th>No</th>
			<th>@sortablelink('client_id','Nom et prenom')</th>
			<th>@sortablelink('name','Numéro de compte')</th>
			<th>@sortablelink('montant','Montant (FBU)') </th>
			
			<th>Action</th>
		</tr>
	</thead>
	<tbody>

		@foreach($comptes as $key=> $compte)
		<tr>
			<td>{{$key + 1}}</td>
			<td>{{ $compte->client->nom .' '.$compte->client->prenom}}</td>
			<td>{{ $compte->name }}</td>
			<td>{{ $compte->montant}}</td>
			<td>
			{{-- 	<a href="{{ route('comptes.show',$compte) }}" class="btn btn-outline-info btn-sm">show</a> --}}
				<a href="{{ route('comptes.edit',$compte) }}" class="btn btn-outline-dark btn-sm">Modifier</a>
			
					<form action="{{ route('comptes.destroy' , $compte) }}" style="display: inline;" method="POST">
					{{ csrf_field() }}
					{{ method_field('DELETE') }}
					<button class="btn btn-outline-danger btn-sm">Supprime</button>
				</form>
				
				
			</td>
		</tr>

		@endforeach
	</tbody>
</table>

{{ $comptes->links()}}


@endif



@endsection