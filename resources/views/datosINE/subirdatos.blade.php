@extends('adminlte::layouts.app')


@section('main-content')

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Inserta aquí la dirección del archivo del INE que quieras subir</h3>
    <br>
    <p><a href="https://www.ine.es/">Acceso al INE </a></p>

  </div>
  <div class="box-body"> 
<form class="form-horizontal" role="form" method="POST" action="{{ url('/datosINE/confirmarsubida') }}">
  {{ csrf_field() }}
<div class="form-group">
      <label for="url" class="col-md-4 control-label"> Dirección</label>
      <div class="row">
            <div class="form-group form-group-options col-md-4 col-md-offset-5">
              <input type="text" name="url" class="form-control" required>
          </div>
      </div>
</div>
<div class="form-group">
          <div class="col-md-8 col-md-offset-4">
              <input type="submit" value="Aceptar" class="btn btn-primary"  > 
          </div>
      </div>
@endsection