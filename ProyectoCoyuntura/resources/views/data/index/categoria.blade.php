@extends('adminlte::layouts.app')


@section('main-content')
<div align="right">
<a align="right" href="{{ url('data/create/categorias/')}}" class="btn btn-success" role="button">Crear categoria</a><br><br>
</div>
<table class="table table-striped">
  <tr>
    <th>Nombre</th>
    <th>Super categoria</th>
    <th></th>
  </tr>

  @for ($i = 0; $i < count($categorias); $i++)
    <tr>
      <td>{{ $categorias[$i]->Nombre }}</td>
      <td>{{ $supercategorias[$i][0]->Name }}</td>
      <td class="col-xs-3"><a href="{{ url('data/edit/categorias/')}}/{{$categorias[$i]->idCategoria}}" class="btn btn-warning" role="button">Modificar</a> 
                           <a href="{{ url('data/delete/categorias/')}}/{{$categorias[$i]->idCategoria}}" class="btn btn-danger"> Borrar</a>
      </td>
    </tr>
  @endfor
</table>
@endsection
