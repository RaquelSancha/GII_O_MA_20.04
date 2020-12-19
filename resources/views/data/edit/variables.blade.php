@extends('adminlte::layouts.app')


@section('main-content')

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Modificar variable "{{$variables[0]->Nombre}}"</h3>
  </div>
  <div class="box-body">      
    
<form class="form-horizontal" role="form" method="POST" action="{{ url('/confirm/data/edit/variable')}}/{{$id}}">
  {{ csrf_field() }}

  @for ($i = 0; $i < count($variables); $i++)
    <div class="form-group">
      <label for="nombre_variable" class="col-md-4 control-label"> Nombre de la variable</label>
      <div class="row">
            <div class="form-group form-group-options col-md-4 col-md-offset-5">
              <input type="text" name="nombre_variable" class="form-control" placeholder="{{$variables[$i]->Nombre}}">
          </div>
      </div>
    </div>
    <div class="form-group">
      <label for="descripcion" class="col-md-4 control-label"> Descripción</label>
      <div class="row">
            <div class="form-group form-group-options col-md-4 col-md-offset-5">
               <textarea class="form-control" rows="5" name="descripcion" placeholder="{{$variables[$i]->Descripcion}}" ></textarea>
          </div>
      </div>
    </div>
    <div class="form-group">
      <label for="tipo" class="col-md-4 control-label"> Tipo</label>
      <div class="row">
            <div class="form-group form-group-options col-md-4 col-md-offset-5">
            <input type="text" name="tipo" class="form-control" placeholder="{{$variables[$i]->Tipo}}">
          </div>
      </div>
    </div>
    <div class="form-group">
      <label for="descripcion" class="col-md-4 control-label"> Fuente</label>
      <div class="row">
            <div class="form-group form-group-options col-md-4 col-md-offset-5">
              <input type="text" name="fuente" class="form-control" placeholder="{{$fuentes[$i]->Name}}">
          </div>
      </div>
    </div>
    <div class="form-group">
          <div class="col-md-8 col-md-offset-4">
              <input type="submit" value="Modificar" onclick="return confirm('Se modificarán los valores de la Base de datos,¿Estás seguro?')" class="btn btn-primary"  > 
          </div>
      </div>
  @endfor
  </div>
</div>
@endsection
