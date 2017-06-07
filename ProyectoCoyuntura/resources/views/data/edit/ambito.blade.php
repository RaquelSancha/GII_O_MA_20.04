@extends('adminlte::layouts.app')


@section('main-content')

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Modificar ambito "{{$ambitos[0]->Nombre}}"</h3>
  </div>
  <div class="box-body">      
    
<form class="form-horizontal" role="form" method="POST" action="{{ url('/confirm/data/edit/ambito')}}/{{$id}}">
  {{ csrf_field() }}

    <div class="form-group">
      <label for="nombre_ambito" class="col-md-4 control-label"> Renombrar ámbito</label>
      <div class="row">
            <div class="form-group form-group-options col-md-4 col-md-offset-5">
              <input type="text" name="nombre_ambito" class="form-control" placeholder="{{$ambitos[0]->Nombre}}">
          </div>
      </div>
    </div>
    <div class="form-group">
          <div class="col-md-8 col-md-offset-4">
              <input type="submit" value="Modificar" onclick="return confirm('Se modificarán los valores de la Base de datos,¿Estás seguro?')" class="btn btn-primary">
          </div>
      </div>
  </div>
</div>
@endsection
