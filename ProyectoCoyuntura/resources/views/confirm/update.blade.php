@extends('adminlte::layouts.app')


@section('main-content')

{{$new_categoria}}

{{$supercategoria}}

{{$new_supercategoria}}
<h1> La tabla se ha actualizado correctamente.</h1>
<div>
<a class="btn btn-success  " href="/tables" role="button">Volver al inicio</a>
</div>

@endsection
