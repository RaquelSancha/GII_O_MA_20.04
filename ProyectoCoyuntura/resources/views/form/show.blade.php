@extends('adminlte::layouts.app')


@section('main-content')
<form class="form-horizontal" role="form" method="POST" action="{{ url('tables')}}/{{$id}}">
 {{ csrf_field() }}
@include('form.form')
</form>
@endsection
