@extends('adminlte::layouts.app')


@section('main-content')

<h2><b>Crear</b> Tabla</h1><hr>

<form class="form-horizontal" role="form" method="POST" action="{{ url('tables')}}">
  {{ csrf_field() }}
  <div class="form-group ">
    <div class="col-md-2 ">
      <label for="variable">Introduce un título:</label>
      <input type="text" class="form-control" id="variable">
    </div>
  </div>
</form>