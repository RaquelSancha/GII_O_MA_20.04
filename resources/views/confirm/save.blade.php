@extends('adminlte::layouts.app')
@section('main-content')
<h1> La tabla se ha creado correctamente.</h1>
<div>
	<a class="btn btn-primary  " href="{{ url('/data/choose')}}" role="button">Administrar los datos guardados</a>
	<a class="btn btn-success  " href="{{ url('/tables')}}" role="button">Volver al inicio</a>
</div>
@endsection
