@extends('adminlte::layouts.app')
@section('main-content')
<div align="right">
<a align="right" href="{{ url('data/create/supercategorias/')}}" class="btn btn-success" role="button">Crear super categoria</a><br><br>
</div>
<table class="table table-striped">
  <tr>
    <th>Nombre</th>
    <th>Categorias</th>
    <th></th>
  </tr>

  @for ($i = 0; $i < count($supercategorias); $i++)
    <tr>
      <td>{{ $supercategorias[$i]->Name }}</td>
      <td>
           @for ($j = 0; $j < count($categorias[$i]); $j++)
              @if($j+1<count($categorias[$i]))
                  {{$categorias[$i][$j]->Nombre}},
              @else
                  {{$categorias[$i][$j]->Nombre}}.
              @endif
           @endfor
      </td>
    <td class="col-xs-3"><a href="{{ url('data/edit/supercategorias/')}}/{{$supercategorias[$i]->idSuperCategoria}}" class="btn btn-warning" role="button">Modificar</a> 
                        @if ($supercategorias[$i]->Name != "Sin categoria")
                        <a href="{{ url('data/delete/supercategorias/')}}/{{$supercategorias[$i]->idSuperCategoria}}" onclick="return confirm('Al borrar la tabla, se perderan los datos de la Base de Datos, ¿Estás seguro de querer borrarla?')" class="btn btn-danger">Borrar</a></td>
                        @endif
      </td>
    </tr>
  @endfor
</table>
@endsection
