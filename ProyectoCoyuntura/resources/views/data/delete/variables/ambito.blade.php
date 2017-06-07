@extends('adminlte::layouts.app')


@section('main-content')
<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Borrar ámbito </h3>
  </div>
  <div class="box-body">      
    
<form class="form-horizontal" role="form" method="POST" action="{{ url('/data/delete/variables/ambito')}}/{{$id}} ">
  {{ csrf_field() }}

   @if(!(empty($variables)))
   <div class="form-group">
      <label for="variables" class="col-md-4 control-label"> Selecciona las variables donde <br>quieres quitar el ámbito geográfico "{{$ambitos[0]->Nombre}}"</label>
      <div class="row">
            <div class="form-group form-group-options col-md-4 col-md-offset-5">
              <select class="selectpicker" data-live-search="true"  multiple data-actions-box="true" name="variables[]">
                @foreach($variables as $all)
                  <option>{{$all->Nombre}}</option>
                @endforeach
              </select>
          </div>
      </div>
    </div>
    <div class="form-group">
          <div class="col-md-8 col-md-offset-4">
              <input type="submit" value="Borrar" onclick="return confirm('Se modificarán los valores de la Base de datos,¿Estás seguro?')" class="btn btn-primary"  > 
          </div>
      </div>

    @else
    El ámbito geográfico "{{$ambitos[0]->Nombre}}" no está en ninguna variable, ¿deséas borrarlo de la aplicación?
      
      <a class= "btn btn-success" href="{{ url('data/delete/ambito/full')}}/{{$id}}" role="button">SI</a>
      <a class= "btn btn-danger" href="javascript:history.back(-1);" role="button">NO</a>
    @endif
  </form>
  </div> 
</div>
@endsection
