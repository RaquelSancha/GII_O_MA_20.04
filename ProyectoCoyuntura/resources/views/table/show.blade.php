@extends('adminlte::layouts.app')


@section('main-content')

<h2><b>Tablas</b> Predefinidas</h1><hr>
<table summary="Indicadores de Demanda" class="table table-condensed table-striped"  align="center" >


  
  <thead >
    <tr class="danger">
      <th rowspan="2" class="col-sm-4"></th>
      <th colspan="12" class="col-sm-2">2011</th>
    </tr>

    <tr class="danger">
      @foreach($variableAmbitos as $variable)
      <th scope="col">{{ $variable->Mes}}</th>
      @endforeach

     
    </tr>

  </thead>
 
  <tbody>
	
    <tr class="danger">
      <th scope="row" >Consumo</th> <td colspan="4"></td>
    </tr>
    <tr class="danger" >
      <th scope="row">	IPI bienes de consumo*</th><td>3</td><td>5</td><td>8</td><td>4</td>
    </tr>
    <tr class="danger">
      <th scope="row">	Importacion de bienes de consumo</th><td>4</td><td>4</td><td>7</td><td>3</td>
    </tr>
    <tr class="danger">
      <th scope="row">	natriculación de turismos</th><td>5</td><td>7</td><td>6</td><td>2</td>
    </tr>
  </tbody>

</table>
 
</body>
@endsection
