@extends('adminlte::layouts.app')


@section('main-content')
<h2>Crear Tablas:  <b>{{$variable}}</b></h1><hr>
@include('table.table')
<form class="form-horizontal" role="form" method="POST" action="{{ url('confirm/save')}}" >
    {{ csrf_field() }}

    <div class="form-group">
     <label for="categoria" class="col-md-4 control-label"></label>
      <div class="col-md-2">
    	<input type="hidden" name="categoria[]" value={{ $categoria }} >
      </div>
  	</div>

	
	<div>
    <input class="btn btn-success"  type="submit" value="Guardar Tabla" />
	</div>
</form>
@endsection