
@extends('adminlte::layouts.app')


@section('main-content')



<h2><b>Tablas</b> Predefinidas</h1><hr>

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
      <td>{{ $variables[$i]->Descripcion }}</td>
      <td>{{ $variables[$i]->Tipo }}</td>
      <td>{{ $fuentes[$i][0]->Name}}</td>
      <td class="col-xs-3"><a href="{{ url('form')}}/{{$variables[$i]->idVariable}}" class="btn btn-success" role="button">Ver tabla</a>  
                          <a href="{{ url('tables')}}/{{$variables[$i]->idVariable}}/{{'edit'}}" class="btn btn-warning" role="button">Modificar Valores</a>  
                          <a href="{{ url('tables')}}/{{$variables[$i]->idVariable}}/{{'delete'}}" onclick="return confirm('Al borrar la tabla, se perderan los datos de la Base de Datos, ¿Estás seguro de querer borrarla?')" class="btn btn-danger"> Borrar</a>
      </td>
    </tr>
  @endfor
</table>

 
@endsection
