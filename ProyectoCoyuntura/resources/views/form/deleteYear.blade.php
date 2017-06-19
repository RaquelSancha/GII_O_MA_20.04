@extends('adminlte::layouts.app')


@section('main-content')

<div class="box">
	<div class="box-header with-border">
		<h3 class="box-title">Selecciona los años que deseas borrar</h3>
	</div>
	<div class="box-body">			
		
<form class="form-horizontal" role="form" method="POST" action="{{ url('/confirm/deleteYear')}}/{{$id}}">
  {{ csrf_field() }}

  <div class="form-group">
      <label for="years" data-width="auto" class="col-md-4 control-label">Selecciona los años</label>
      <div class="col-md-2">
          <select class="selectpicker dropup" data-live-search="true"  multiple data-actions-box="true" name="years[]" title="">
            @foreach($years as $year)
            <option>{{$year->Year}}</option>
            @endforeach
          </select>
          
      </div>
  </div>
  <div class="form-group">
      <div class="col-md-8 col-md-offset-4">
         <input type="submit" value="Borrar" class="btn btn-primary"  > 
      </div>
  </div>

</div>
@endsection