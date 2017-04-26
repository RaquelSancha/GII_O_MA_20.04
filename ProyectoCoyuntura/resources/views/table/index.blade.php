@extends('adminlte::layouts.app')


@section('main-content')

<h2><b>Tablas</b> Predefinidas</h1><hr>
<table class="table table-striped">
  <tr>
  	<th>Id</th>
    <th>Descripcion</th>
    <th>Tipo</th>
  </tr>
  @foreach($variables as $variable)
    <tr>

      <td >{{ $variable->idVariable }}</th>
      <td style="cursor:pointer"><a href="{{ url('tables')}}/{{$variable->idVariable}}">{{ $variable->Descripcion }}</a></th>
      <td class="col-xs-3">{{ $variable->Tipo }}
      </td>
    </tr>
  @endforeach
@endsection
