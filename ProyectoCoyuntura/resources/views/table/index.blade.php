
@extends('adminlte::layouts.app')


@section('main-content')

<h2><b>Tablas</b> Predefinidas</h1><hr>
<table class="table table-striped">
  <tr>
  	<th>Id</th>
    <th>Descripcion</th>
    <th></th>
    <th></th>

  </tr>
  @foreach($variables as $variable)
    <tr>

      <td >{{ $variable->idVariable }}</td>
      <td style="cursor:pointer"><a href="{{ url('form')}}/{{$variable->idVariable}}">{{ $variable->Nombre }}</a></td>
      <td></td>
      <td class="col-xs-3"><a href="{{ url('tables')}}/{{$variable->idVariable}}/{{'edit'}}" class="btn btn-warning" role="button">Modificar</a>  <a href="{{ url('tables')}}/{{$variable->idVariable}}/{{'edit'}}" class="btn btn-danger" role="button">Borrar</a></td>
    </tr>
  @endforeach
</table>
 
@endsection
