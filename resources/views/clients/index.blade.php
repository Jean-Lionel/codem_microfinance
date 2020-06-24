@extends('layouts.app')

@section('content')

<div class="row">
	<div class="col-md-8">
		<b>Liste des clients</b>	
	</div>
	<div class="col-md-4 col-sm-6">
		<form action="" class="navbar-form navbar-left">
			<div class="input-group row custom-search-form">

				<input type="text" class="form-control col-md-8 " name="search" placeholder="Search..." value="{{$search}}" >
				
					<button class="btn btn-default-sm" type="submit">
						<i class="fa fa-search"></i>
					</button>
			

			</div>
		</form>
	</div>
</div>



<a href="{{ route('clients.create')}}" class="btn btn-info">Ajouter un client</a>

@if($clients)

<table class="table table-sm table-bordered table-inverse table-hover">
	<thead>
		<tr>
			<th>No</th>
			<th>@sortablelink('nom','Nom')</th>
			<th>@sortablelink('prenom','Prénom') </th>
			<th>@sortablelink('cni','CNI')</th>
			<th>Compte</th>
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
			<td>{{ $client->cni}}</td>
			<td>
				<ul>
					@foreach ($client->comptes as $compte)

					<li>{{$compte->name  }}</li>
					@endforeach
				</ul>
			</td>
			<td>{{ $client->antenne}}</td>
			<td>{{ $client->date_naissance}}</td>
			<td>{{ $client->created_at}}</td>
			<td>
				<a href="{{ route('clients.show',$client) }}" class="btn btn-outline-info btn-sm">show</a>
				<a href="{{ route('clients.edit',$client) }}" class="btn btn-outline-dark btn-sm">Modifier</a>

				<form action="{{ route('clients.destroy' , $client) }}" style="display: inline;" method="POST">
					{{ csrf_field() }}
					{{ method_field('DELETE') }}
					<button class="btn btn-outline-danger btn-sm">Delete</button>
				</form>


			</td>
		</tr>

		@endforeach
	</tbody>
</table>

{{ $clients->links()}}


@endif



@endsection