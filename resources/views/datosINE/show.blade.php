@extends('adminlte::layouts.app')
@section('main-content')

<div class="box">
<div class="box-body">		
<h3 class="box-title">Introduce los datos en una tabla existente o crea una nueva </h3>
    <br>
	<form class="form-horizontal" role="form" method="POST" action="{{ url('datosINE/insertarDatos')}}/{{$id}}">
	 {{ csrf_field() }}
 

   <div class="form-group">
  <label for="variables" class="col-md-4 control-label"> Selecciona una variable de las existentes</label>
    <div class="row">
      <div class="form-group form-group-options col-md-4 col-md-offset-5">
          <select data-live-search="true" data-width="auto" class="selectpicker dropup show-tick"  name="variable" id="variable" title="" > 
          @foreach($variables as $variable)
                <option>{{$variable->Nombre}}</option>
          @endforeach 
          </select>  
      </div>
   </div>
   </div>

   <div class="form-group">
  <label for="categorias" class="col-md-4 control-label"> Selecciona una categoría de las existentes</label>
    <div class="row">
      <div class="form-group form-group-options col-md-4 col-md-offset-5">
          <select data-live-search="true" data-width="auto" class="selectpicker dropup show-tick"  name="categoria" id="categoria" title="" > 
          @foreach($categorias as $categoria)
                <option>{{$categoria->Nombre}}</option>
          @endforeach 
          </select> 
      </div>
   </div>
   </div>


   <div class="form-group">
  <label for="ambitos" class="col-md-4 control-label"> Selecciona un ámbito de los existentes</label>
    <div class="row">
      <div class="form-group form-group-options col-md-4 col-md-offset-5">
          <select data-live-search="true" data-width="auto" class="selectpicker dropup show-tick"  name="ambito" id="ambito" title="" > 
          @foreach($ambitos as $ambito)
                <option>{{$ambito->Nombre}}</option>
          @endforeach        
          </select>
      </div>
   </div>
   </div> 


   @if(empty($tiempos))  
   <div class="form-group" >
    <div class="row">
      <div class="form-group form-group-options col-md-4 col-md-offset-5" align= "center">
        <label for="fecha" data-width="auto" required>Escribe el año al que pertenecen los datos</label>
        <input type="text" id="fecha" name="fecha"><br><br>
      </div>
   </div>
   </div> 
   @endif     
  <div class="col-md-8 col-md-offset-4">
    <input type="submit" value="Aceptar" class="btn btn-primary"  > 
  </div>
  <br><br>

  <div  class="col-md-8 col-md-offset-4">
      <a href="{{ url('/form/create')}}"  class="btn btn-primary " role="button">Crear tabla</a>      
    </div>   
</div>
</div>
</form>
<br><br>

<div id="table_wrapper">
<div class="table-responsive">
<table  class="table table-striped header-fixed"  id="tabla" align="center" border="5" class="display nowrap" cellspacing="0" width="50%">
   @if(!empty($tiempos))
        <thead>
        <tr>
        <th scope="row"></th>
                @foreach(array_keys($tiempos) as $tiempo)
                <th colspan="{{count($tiempos[$tiempo][0])}}" align="center" bgcolor= "#60B664" style="color:White;">{{ $tiempo}}</th>
                @endforeach
        </tr>
            @if(array_key_exists('Periodo',$valores[0]['Datos'][0]))
            <tr  bgcolor= "#01A556" style="color:White;">
            <th></th>
            @foreach(array_keys($tiempos) as $tiempo)
                  @for($j = 0; $j< count($tiempos[$tiempo]); $j++)
                     @for($k = 0; $k< count($tiempos[$tiempo][$j]); $k++)
                         <td>{{ $tiempos[$tiempo][$j][$k] }}</td>
                     @endfor
                  @endfor
            @endforeach
            </tr>
        @endif
        </thead>
    @endif
    <tbody>
    @for($i=0 ; $i<count($valores) ; $i++ )
    <tr>
    <th bgcolor= "#01A556" style="color:White;">{{$valores[$i]['Nombre']}}</th>
      @for($j=0 ; $j<count($valores[$i]['Datos']) ; $j++ )
          <td  bgcolor="#FFFFFF" style="color:Black;" >{{ $valores[$i]['Datos'][$j]['Valor'] }}</td>
      @endfor
      </tr>
    @endfor
    </tbody>
    </table>
</div>
</div>
@endsection

 