@extends('layouts.app')

@section('content')




<form action="{{ route('comptes.store')}}" method="POST">

	@include('comptes._form',['btnTitle' => 'Enregistrers'])

</form>


@endsection