@extends('adminlte::layouts.app')


@section('main-content')

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Editar usuario "{{$user->name}}"</h3>
  </div>
  <div class="box-body"> 
<form class="form-horizontal" role="form" method="POST" action="{{ url('/confirm/user/editarPerfil')}}/{{$id}}">
  {{ csrf_field() }}
<div class="form-group">
      <label for="nombre_usuario" class="col-md-4 control-label"> Nombre</label>
      <div class="row">
            <div class="form-group form-group-options col-md-4 col-md-offset-5">
              <input type="text" name="nombre_usuario" class="form-control" placeholder="{{$user->Name}}">
          </div>
      </div>
</div>
    <div class="form-group">
      <label for="email" class="col-md-4 control-label"> Email</label>
      <div class="row">
            <div class="form-group form-group-options col-md-4 col-md-offset-5">
             <input type="text" name="email" class="form-control" placeholder="{{$user->Email}}">
          </div>
      </div>
    </div>
    <div class="form-group">
      <label for="contraseña" class="col-md-4 control-label"> Contraseña</label>
      <div class="row">
            <div class="form-group form-group-options col-md-4 col-md-offset-5">
             <input type="password" name="contraseña" class="form-control" placeholder="{{$user->password}}">
            </div>
      </div>
    </div>
    <div class="form-group">
          <div class="col-md-8 col-md-offset-4">
              <input type="submit" value="Modificar" onclick="return confirm('Se modificarán los valores de la Base de datos,¿Estás seguro?')" class="btn btn-primary"  > 
          </div>
      </div>
      @endsection