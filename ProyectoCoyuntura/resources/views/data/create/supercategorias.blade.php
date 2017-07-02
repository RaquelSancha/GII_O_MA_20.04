@extends('adminlte::layouts.app')


@section('main-content')

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Crea una nueva super categoria</h3>
  </div>
  <div class="box-body">      
    
<form class="form-horizontal" role="form" method="POST" action="{{ url('/confirm/data/new/supercategoria') }}">
  {{ csrf_field() }}

    <div class="form-group">
      <label for="nombre_supercategoria" class="col-md-4 control-label"> Nombre de la super categoría</label>
      <div class="row">
            <div class="form-group form-group-options col-md-4 col-md-offset-5">
              <input type="text" name="nombre_supercategoria" class="form-control" required>
          </div>
      </div>
    </div>
    <div class="form-group">
      <label for="nombre_supercategoria" class="col-md-4 control-label"> Añade categorías sin super categoría</label>
      <div class="row">
            <div class="form-group form-group-options col-md-4 col-md-offset-5">
              <select class="selectpicker dropup" data-live-search="true"  multiple data-actions-box="true" name="categoriasPoner[] " title="">
                @foreach($categorias as $all)
                  <option>{{$all->Nombre}}</option>
                @endforeach
              </select>
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
