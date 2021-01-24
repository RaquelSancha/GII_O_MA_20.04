@extends('adminlte::layouts.app')
@section('main-content')
<?php $asterisco=0;?>
<h2><b>Predicciones de la variable "{{ $nombreVariable }}"</b></h1><hr>

<div class="table-responsive">
<table  class="table table-striped header-fixed"  id="Tabla normal" align="center" border="5" class="display nowrap" cellspacing="0" width="100%">
    <thead >
      <tr>
        <th rowspan="2"></th>
        <th colspan="12" align="center" bgcolor= "#60B664" style="color:White;">{{ $año }}</th>
      </tr>

      <tr  bgcolor= "#01A556" style="color:White;">
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
      </tr>
    </thead>
    <tbody>
        <tr>
          <th scope="row" bgcolor="#000000" style="color:White;" >{{$ambito }}
              <td colspan="12" bgcolor="#000000" style="color:White;" ></td>
          </th>
        </tr>
        <tr>
            <th scope="row">{{ $categoria }}</th> 
            @for ($i = 0; $i < count($predicciones); $i++)
                <td>{{ $predicciones[$i] }}</td>
            @endfor
          </tr>  
    </tbody>
</table>
</div>
@endsection
