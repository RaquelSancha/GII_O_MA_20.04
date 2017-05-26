@extends('adminlte::layouts.app')


@section('main-content')
<h2>Crear Tablas:  <b>{{$variable}}</b></h1><hr>
@include('table.table')
</form>

<div align="right">
<a href="/confirm/save" class="btn btn-primary btn-lg active" role="button">Guardar tabla </a>
</div>
@endsection