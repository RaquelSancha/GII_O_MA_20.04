@extends('adminlte::layouts.app')


@section('main-content')

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Modificar super categoria "{{$supercategorias[0]->Name}}"</h3>
  </div>
  <div class="box-body">      
    
<form class="form-horizontal" role="form" method="POST" action="{{ url('/confirm/data/edit/supercategoria')}}/{{$id}}">
  {{ csrf_field() }}

    <div class="form-group">
      <label for="nombre_supercategoria" class="col-md-4 control-label"> Nombre de la supercategoria</label>
      <div class="row">
            <div class="form-group form-group-options col-md-4 col-md-offset-5">
              <input type="text" name="nombre_supercategoria" class="form-control" placeholder="{{$supercategorias[0]->Name}}">
          </div>
      </div>
    </div>
    <div class="form-group">
      <label for="nombre_supercategoria" class="col-md-4 control-label"> Categorias asignadas que deseas quitar</label>
      <div class="row">
            <div class="form-group form-group-options col-md-4 col-md-offset-5">
              <select class="selectpicker" data-live-search="true"  multiple data-actions-box="true" name="categoriasQuitar[]">
                @foreach($categorias as $cat)
                  <option>{{$cat->Nombre}}</option>
                @endforeach
              </select>
          </div>
      </div>
    </div>
    <div class="form-group">
      <label for="nombre_supercategoria" class="col-md-4 control-label"> Categorias que deseas añadir</label>
      <div class="row">
            <div class="form-group form-group-options col-md-4 col-md-offset-5">
              <select class="selectpicker" data-live-search="true"  multiple data-actions-box="true" name="categoriasPoner[]">
                @foreach($AllCategorias as $all)
                  <option>{{$all->Nombre}}</option>
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

<script type="text/javascript">
$(".js-example-basic-multiple").select2();
</script>
@endsection
