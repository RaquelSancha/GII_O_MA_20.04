@extends('adminlte::layouts.app')


@section('main-content')
<h2>Crear Tabla:  <b>{{$variable}} ({{$tipo}})</b></h1><hr>
{{$descripcion}}<br>
@include('table.table')
<br>
<form class="form-horizontal" role="form" method="POST" action="{{ url('confirm/save') }}" >
 {{ csrf_field() }}
    <div class="form-group">
      @foreach($categoria as $aux)
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
    </div>
    <b>Fuente:</b> "{{$fuente}}" 
    <div align="right">
        <a class= "btn btn-success" href="javascript:history.back(-1);" role="button">Volver</a>
        <input class="btn btn-success"  type="submit" value="Guardar" />
    </div>
</form>

@endsection
