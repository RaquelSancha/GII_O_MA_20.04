@extends('adminlte::layouts.app')


@section('main-content')

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Crea una nueva categoria</h3>
  </div>
  <div class="box-body">      
    
<form class="form-horizontal" role="form" method="POST" action="{{ url('/confirm/data/new/categoria') }}">
  {{ csrf_field() }}

    <div class="form-group">
      <label for="nombre_categoria" class="col-md-4 control-label"> Nombre de la categoría</label>
      <div class="row">
            <div class="form-group form-group-options col-md-4 col-md-offset-5">
              <input type="text" name="nombre_categoria" class="form-control">
          </div>
      </div>
    </div>
    <div class="form-group">
      <label for="nombre_supercategoria" class="col-md-4 control-label"> Asigna la categoría a una super categoria</label>
      <div class="row">
            <div class="form-group form-group-options col-md-4 col-md-offset-5">
              <select class="selectpicker" data-live-search="true" data-actions-box="true" name="supercategorias" title="Escoge una super categoria...">
                @foreach($supercategorias as $all)
                  <option>{{$all->Name}}</option>
                @endforeach
              </select>
          </div>
      </div>
    </div>
    
    <div class="form-group">
          <div class="col-md-8 col-md-offset-4">
              <input type="submit" value="Modificar" onclick="return confirm('Se modificarán los valores de la Base de datos,¿Estás seguro?')" class="btn btn-primary"  > 
          </div>
      </div>
  </div>
</div>
@endsection
