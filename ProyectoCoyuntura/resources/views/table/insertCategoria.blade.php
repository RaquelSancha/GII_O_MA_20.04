@extends('adminlte::layouts.app')


@section('main-content')

<h2><b>Tablas</b> Predefinidas:
@foreach($nombreVariable as $nom)
{{$nom->Nombre}}
@endforeach
</h1>

<form class="form-horizontal" role="form" method="POST" action="{{ url('confirm/insertCategoria')}}/{{$id}}" >
{{ csrf_field() }}
<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">  Rellena el formulario</h3>
  </div>
  <div class="box-body">      
    <div class="form-group">
      <label for="nombre_categoria" class="col-md-4 control-label"> Introduce el nombre de la categoría</label>
        <div class="row">
          <div class="form-group form-group-options col-md-4 col-md-offset-3">
            <input type="text" name="new_categoria" class="form-control" required>
          </div>
        </div>
    </div>
    <div class="form-group">
      <label for="nombre_supercategoria" class="col-md-4 control-label">Añade una nueva super categoria o escoge una</label>
      <div class="row">
        <div class="form-group form-group-options col-md-4 col-md-offset-3">
          <input type="text" name="new_supercategoria" class="form-control">
          
          <select class="selectpicker" data-live-search="true" title="Escoge una categoria..." name="supercategoria">
            @foreach($supercategorias as $sCat)
            <option>{{$sCat->Name}}</option>
            @endforeach
          </select>         
        </div>
      </div>
    </div>
  </div>
</div> 
<div class="table-responsive">
<table  class="table table-striped"  align="center" border="5">
 <thead >
      <tr>
        <th rowspan="2"></th>
        @foreach($years as $year)
        <th colspan="12" align="center" bgcolor= "#60B664" style="color:White;">{{ $year->Year}}</th>
        @endforeach
      </tr>

      <tr  bgcolor= "#01A556" style="color:White;">
        @foreach($years as $year)
        <th scope="col">Ene</th>
        <th scope="col">Feb</th>
        <th scope="col">Mar</th>
        <th scope="col">Abr</th>
        <th scope="col">May</th>
        <th scope="col">Jun</th>
        <th scope="col">Jul</th>
        <th scope="col">Ago</th>
        <th scope="col">Sep</th>
        <th scope="col">Oct</th>
        <th scope="col">Nov</th>
        <th scope="col">Dic</th>
        @endforeach
      </tr>
    </thead>
    <tbody>
      <div class="form-group">
      <label for="update"></label>
      <tr>
      @for ($l = 0; $l < count($ambitos); $l++)
        <th scope="row" bgcolor="#000000" style="color:White;" >{{$ambitos[$l]->Nombre }} </th>
            @for ($k = 0; $k < (12*count($years)); $k++)   
              <td ><input style="width:80px;" type="number" step="0.01" class="form-control input-sm" placeholder="-" name="update[]"></td>
            @endfor
          </tr>  
        @endfor
   
      </div>
    </tbody> 
</table>
</div>
<br>
<div>
    <div align= "right"><a class= "btn btn-success" href="javascript:history.back(-1);" role="button">Volver</a>
    <input class="btn btn-success"  type="submit" value="Enviar" onclick="return confirm('Se modificarán los valores de la Base de datos,¿Estás seguro?')" />
</div>
</form>
@endsection
