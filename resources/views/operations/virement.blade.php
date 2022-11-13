@extends('layouts.app')

@section('content')

<div class="row">
	@include('operations.side')
	<div class="col-md-10 col-sm-12">
		<div class="row">
			<div class="col-md-4">
				@livewire("virement.orgin-component")
			</div>
		</div>
	</div>
</div>

@stop