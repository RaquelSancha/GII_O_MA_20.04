@extends('adminlte::layouts.app')


@section('main-content')

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Crea un nuevo ámbito</h3>
  </div>
  <div class="box-body">      
    
  <form class="form-horizontal" role="form" method="POST" action="{{ url('/confirm/data/new/ambito') }}">
  {{ csrf_field() }}

    <div class="form-group">
      <label for="nombre_ambito" class="col-md-4 control-label"> Nombre del ámbito</label>
      <div class="row">
        <div class="form-group form-group-options col-md-4 col-md-offset-5">
          <input type="text" name="nombre_ambito" class="form-control" required>
        </div>
      </div>
    </div>
    <div class="form-group">
      <div class="col-md-8 col-md-offset-4">
        <input type="submit" value="Crear" onclick="return confirm('Se modificarán los valores de la Base de datos,¿Estás seguro?')" class="btn btn-primary"  > 
      </div>
    </div>
  </div>
</div>
@endsection
