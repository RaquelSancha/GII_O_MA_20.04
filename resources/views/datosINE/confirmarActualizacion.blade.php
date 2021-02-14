@extends('adminlte::layouts.app')
@section('main-content')
<h1> Datos actualizados correctamente.</h1>
<p>Se han actualizado las siguientes tablas</p><br>
@for ($i = 0; $i < count($nomVarActualizadas); $i++)
<p>{{$nomVarActualizadas[$i]}}</p><br>
@endfor
@endsection
