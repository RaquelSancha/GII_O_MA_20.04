@extends('adminlte::layouts.app')


@section('main-content')

<div class="box">
	<div class="box-header with-border">
		<h3 class="box-title">	Rellena el formulario</h3>
	</div>
	<div class="box-body">		
<form class="form-horizontal" role="form" method="POST" action="{{ url('tables')}}/{{$id}}">
 {{ csrf_field() }}
@include('form.form')
</form>
	</div>
</div>
@endsection
