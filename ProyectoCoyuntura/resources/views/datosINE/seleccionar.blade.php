@extends('adminlte::layouts.app')


@section('main-content')

<div class="box">
	<div class="box-header with-border">
		<h3 class="box-title">	Selecciona los datos que quieres mostrar</h3>
  </div>
<div class="box-body">		
	<form class="form-horizontal" role="form" method="POST" action="{{ url('datosINE/show')}}/{{$id}}">
	 {{ csrf_field() }}
  <div class="form-group">
  <label for="opciones" class="col-md-4 control-label"> Selecciona los datos</label>
    <div class="row">
      <div class="form-group form-group-options col-md-4 col-md-offset-5">
        @foreach($nombres as $nombre)
        @if(!(empty($nombre)))
          <select multiple data-actions-box="true" data-live-search="true" data-width="auto" class="selectpicker dropup show-tick"  name="opciones[]" id="opciones" title="" required> 
              @foreach($nombre as $nom)
                <option>{{$nom}}</option>
              @endforeach
          </select>
        @endif
        @endforeach        
      </div>
   </div>
   @if(!(empty($fechas)))
    <div class="form-group">
      <label for="fechas" class="col-md-4 control-label"> Selecciona las fechas </label>
      <div class="row">
          <div class="form-group form-group-options col-md-4 col-md-offset-5">
            <select multiple data-actions-box="true" data-live-search="true" data-width="auto" class="selectpicker dropup show-tick"  name="fechas[]" id="fechas" title="" required> 
              @for($i=0;$i<count($fechas['Año']);$i++) 
                @for($j=0;$j<count($fechas['Periodo']);$j++) 
                    @if($fechas['Periodo'][$j] == "19")
                    <option>{{$fechas['Año'][$i]}} T1</option>
                    @endif
                    @if($fechas['Periodo'][$j] == "20")
                    <option>{{$fechas['Año'][$i]}} T2</option>
                    @endif
                    @if($fechas['Periodo'][$j] == "21")
                    <option>{{$fechas['Año'][$i]}} T3</option>
                    @endif
                    @if($fechas['Periodo'][$j] == "22")
                    <option>{{$fechas['Año'][$i]}} T4</option>
                    @endif
                @endfor
              @endfor
            </select>  
          </div>
        </div>
     </div>
    @endif
  <div class="col-md-8 col-md-offset-4">
    <input type="submit" value="Aceptar" class="btn btn-primary"  > 
  </div>
</div>
@endsection