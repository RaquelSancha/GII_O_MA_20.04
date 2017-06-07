@extends('adminlte::layouts.app')


@section('main-content')
<div align="right">
<a align="right" href="{{ url('data/create/ambito/')}}" class="btn btn-success" role="button">Crear Ámbito</a><br><br>
</div>
<table class="table table-striped">
  <tr>
    <th>Ámbito</th>
    <th></th>
  </tr>

  @for ($i = 0; $i < count($ambitos); $i++)
    <tr>
      <td>{{ $ambitos[$i]->Nombre }}</td>
  
    <td class="col-xs-3"><a href="{{ url('data/edit/ambito/')}}/{{$ambitos[$i]->idAmbito}}" class="btn btn-warning" role="button">Modificar</a> 
                           <a href="{{ url('data/delete/ambito/')}}/{{$ambitos[$i]->idAmbito}}"  class="btn btn-danger"> Borrar</a></td>
      </td>
    </tr>
  @endfor
</table>
@endsection
