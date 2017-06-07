@extends('adminlte::layouts.app')


@section('main-content')

@for ($i = 0, $j = 0; $i < count($cat); $i++)
{{$cat[$i]}}
@endfor
<h1> La tabla se ha creado correctamente.</h1>
<div>
<a class="btn btn-success  " href="/data/choose" role="button">Volver al inicio</a>
</div>

@endsection
