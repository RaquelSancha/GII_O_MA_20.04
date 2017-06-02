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
      <label for="nombre_variable" class="col-md-4 control-label">Introduce un nombre para la tabla</label>
      <div class="col-md-2">
    	<input type="text" class="form-control input-sm"  name="nombre_variable">
          
      </div>
  </div>

@include('form.form')
	</div>
</div>
@endsection