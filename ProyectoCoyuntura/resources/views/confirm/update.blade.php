@extends('adminlte::layouts.app')


@section('main-content')

<h1> La tabla se ha actualizado correctamente.</h1>
@foreach($update as $upd)
	{{$upd}}
	,
@endforeach

<div>
<a class="btn btn-success  " href="/tables" role="button">Volver al inicio</a>
</div>

@endsection
