@extends('layouts.app')
@section('content')

<div class="container">
	
	<table class="table table-hover table-striped  tbody-sm text-center">
		<thead class="table-info ">
			<tr>
				<th>#</th>
				<th>DATE</th>
				<th>MONTANT (# FBU)</th>
				<th>TOTAL DES COMPTES</th>
				<th>POURCENTANGE</th>
			</tr>
		</thead>

		<tbody >
			
				@foreach ($tenus_comptes as $element)
					{{-- expr --}}
					<tr>
						<td>{{$element->id}}</td>
						<td>{{$element->created_at}}</td>
						<td >{{numberFormat($element->montant)}}</td>
						<td>
							{{$element->comptes_success}}
							
						</td>
						<td class="d-flex justify-content-around">
							<em>
								{{
								calculerPourcentage($element->comptes_success, ($element->comptes_error + $element->comptes_success ))
							}}

							</em>

							<small class="badge-danger">
							{{
								calculerPourcentage($element->comptes_error, ($element->comptes_error + $element->comptes_success ))
							}}
							</small>

						</td>

					</tr>
				@endforeach
			
		</tbody>
	</table>
</div>

@stop