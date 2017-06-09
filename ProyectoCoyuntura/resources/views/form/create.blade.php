@extends('adminlte::layouts.app')


@section('main-content')

<div class="box">
	<div class="box-header with-border">
		<h3 class="box-title">	Rellena el formulario</h3>
	</div>
	<div class="box-body">			
		
<form class="form-horizontal" role="form" method="POST" action="{{ url('/tables/create')}}">
  {{ csrf_field() }}


   <div class="form-group">
      <label for="nombre_variable" class="col-md-4 control-label"> Introduce un nombre para la tabla</label>
      <div class="row">
            <div class="form-group form-group-options col-md-4 col-md-offset-5">
              <input type="text" name="nombre_variable" class="form-control">
          </div>
      </div>
    </div>
  <div class="form-group">
      <label for="fuente" class="col-md-4 control-label"> Introduce la fuente</label>
      <div class="row">
            <div class="form-group form-group-options col-md-4 col-md-offset-5">
              <input type="textarea" name="fuente" class="form-control">
          </div>
      </div>
    </div>
    <div class="form-group">
      <label for="descripcion" class="col-md-4 control-label"> Introduce una descripción</label>
      <div class="row">
            <div class="form-group form-group-options col-md-4 col-md-offset-5">
               <textarea class="form-control" rows="5" name="descripcion"></textarea>
          </div>
      </div>
    </div>
    <div class="form-group">
      <label for="tipo" class="col-md-4 control-label"> Introduce el tipo(Tasa de variación, %, etc)</label>
      <div class="row">
            <div class="form-group form-group-options col-md-4 col-md-offset-5">
              <input type="text" name="tipo" class="form-control">
          </div>
      </div>
    </div>
@include('form.form')
	</div>
</div>
@endsection