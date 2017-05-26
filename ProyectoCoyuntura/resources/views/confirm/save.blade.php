@extends('adminlte::layouts.app')


@section('main-content')


@foreach($categoria as $cat)
	{{ $cat }}
@endforeach
<h1> La tabla se ha creado correctamente.</h1>
<div>
<a class="btn btn-success  " href="/tables" role="button">Volver al inicio</a>
</div>

@endsection
