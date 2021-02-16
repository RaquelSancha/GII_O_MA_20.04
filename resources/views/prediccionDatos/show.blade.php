@extends('adminlte::layouts.app')
@section('main-content')
<div class="box">
	<div class="box-header with-border">
		<h3 class="box-title">	Selecciona el ámbito y la categoría a predecir</h3>
	</div>
	<div class="box-body">		
	<form class="form-horizontal" role="form" method="POST" action="{{ url('prediccionDatos/predecir')}}/{{$id}}">
	 {{ csrf_field() }}
		@include('prediccionDatos.form')
	</form>
	</div>
</div>
@endsection
