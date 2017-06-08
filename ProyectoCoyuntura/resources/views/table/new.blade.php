@extends('adminlte::layouts.app')


@section('main-content')
<h2>Insertar Tabla:  <b>{{$variable}} ({{$tipo}})</b></h1><hr>
{{$descripcion}}
  
 <form class="form-horizontal" role="form" method="POST" action="{{ url('confirm/save') }}" >
    {{ csrf_field() }}
<div class="table-responsive">
<table  class="table table-striped"  align="center" border="5">
 <thead >
      <tr>
        <th rowspan="2"></th>
        @foreach($years as $year)
        <th colspan="12" align="center" bgcolor= "#60B664" style="color:White;">{{ $year}}</th>
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
        <tr>
          <th scope="row" bgcolor="#000000" style="color:White;" >{{$ambitos[$l]}}
              <td colspan="{{12*count($years)}}" bgcolor="#000000" style="color:White;" ></td>
          </th>
        </tr>
        <tr>
      	@for ($i = 0; $i < count($categorias); $i++)
        <th scope="row">{{$categorias[$i]}}</th> 
	        @for ($j = 0; $j < count($years); $j++)
	          @for ($k = 0; $k < 12; $k++)   
	            @if(empty($values[$l][($i * count($years))+$j][$k][0]->valor))
	            	<td ><input type="number" style="width:80px;" step="0.01" class="form-control input-sm" placeholder="-" name="update[]"></td>
	            @else
	            	<td ><input type="number" style="width:80px;" step="0.01" class="form-control input-sm" placeholder="{{$values[$l][($i * count($years))+$j][$k][0]->valor}}" name="update[]"></td>
	            @endif
	          @endfor
	        @endfor
      	</tr>  
      	@endfor
      @endfor
    </tbody>
</table>
</div>
<br>
<!--VARIABLES PASADAS AL CONTROLADOR-->
@foreach($categorias as $aux)
  <input type="hidden" name="categorias[]" value="{{$aux}}" />
@endforeach

@foreach($years as $aux)
  <input type="hidden" name="years[]" value="{{$aux}}" />
@endforeach

@foreach($ambitos as $aux)
  <input type="hidden" name="ambitos[]" value="{{$aux}}" />
@endforeach

<input type="hidden" name="fuente" value="{{$fuente}}" />
<input type="hidden" name="descripcion" value="{{$descripcion}}" />
<input type="hidden" name="tipo" value="{{$tipo}}" />
<input type="hidden" name="variable" value="{{$variable}}" />



<b>Fuente:</b> "{{$fuente}}" 
<div align="right">
    <a class= "btn btn-success" href="javascript:history.back(-1);" role="button">Volver</a>
    <input class="btn btn-success"  type="submit" value="Guardar" />
</div>
</form>
		

@endsection
