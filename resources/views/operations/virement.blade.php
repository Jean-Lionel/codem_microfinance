@extends('layouts.app')

@section('content')

<div class="row">
	@include('operations.side')
	<div class="col-md-10 col-sm-12">
		
				@livewire("virement.orgin-component")
		
		</div>
	</div>
</div>

@stop