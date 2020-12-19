@extends('adminlte::layouts.app')


@section('main-content')

<div class="box">
	<div class="box-header with-border">
		<h3 class="box-title">Selecciona los ámbitos geográficos que deseas borrar</h3>
	</div>
	<div class="box-body">			
		
<form class="form-horizontal" role="form" method="POST" action="{{ url('/confirm/deleteAmbito')}}/{{$id}}">
  {{ csrf_field() }}

  <div class="form-group">
      <label for="ambitos" data-width="auto" class="col-md-4 control-label">Selecciona los ámbitos geográficos</label>
      <div class="col-md-2">
          <select class="selectpicker dropup" data-live-search="true"  multiple data-actions-box="true" required name="ambitos[] " title="">
            @foreach($ambitos as $ambito)
            <option>{{$ambito->Nombre}}</option>
            @endforeach
          </select>
          
      </div>
  </div>
  <div class="form-group">
      <div class="col-md-8 col-md-offset-4">
         <input type="submit" value="Borrar" class="btn btn-primary" > 
      </div>
  </div>

</div>
@endsection