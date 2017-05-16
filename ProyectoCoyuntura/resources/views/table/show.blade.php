@extends('adminlte::layouts.app')


@section('main-content')
<h2><b>Tablas</b> Predefinidas</h1><hr>
@include('table.table')
<div align="right">
<a href="{{ url('tables')}}/{{$id}}/{{'edit'}}" class="btn btn-primary btn-lg active" role="button">Modificar Valores</a>
</div>
@endsection
