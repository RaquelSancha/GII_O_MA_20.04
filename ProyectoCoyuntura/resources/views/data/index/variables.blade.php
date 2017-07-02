@extends('adminlte::layouts.app')
@section('main-content')
<table class="table table-striped">
  <tr>
    <th>Nombre</th>
    <th>Descripción</th>
    <th>Tipo</th>
    <th>Fuente</th>
    <th></th>
  </tr>

  @for ($i = 0; $i < count($variables); $i++)
    <tr>
      <td>{{ $variables[$i]->Nombre }}</td>
      <td style="width:600px;">{{ $variables[$i]->Descripcion }}</td>
      <td>{{ $variables[$i]->Tipo }}</td>
      <td>{{ $fuentes[$i][0]->Name}}</td>
      <td class="col-xs-3"><a href="{{ url('data/edit/variables/')}}/{{$variables[$i]->idVariable}}" class="btn btn-warning" role="button">Modificar</a> 
                           <a href="{{ url('tables')}}/{{$variables[$i]->idVariable}}/{{'delete'}}" onclick="return confirm('Al borrar la tabla, se perderan los datos de la Base de Datos, ¿Estás seguro de querer borrarla?')" class="btn btn-danger"> Borrar</a></td>
      </td>
    </tr>
  @endfor
</table>
@endsection
