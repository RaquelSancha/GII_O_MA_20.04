<?php $asterisco=0;?>
<div class="table-responsive">
<table  class="table table-striped header-fixed"  id="tabla" align="center" border="5" class="display nowrap" cellspacing="0" width="100%">
    <thead>
      <tr>
      <th scope="row">Años</th>
            @foreach($años as $año )
             <th colspan="{{count($periodos)}}" align="center" bgcolor= "#60B664" style="color:White;">{{ $año}}</th>
            @endforeach
      </tr>
    @if(array_key_exists('Periodo',$valores[0]['Datos'][0]))
    <tr  bgcolor= "#01A556" style="color:White;">
    <th></th>
        @if($valores[0]['Datos'][0]['Periodo']=="Enero" || $valores[0]['Datos'][0]['Periodo']=="Febrero" || $valores[0]['Datos'][0]['Periodo']=="Marzo" || $valores[0]['Datos'][0]['Periodo']=="Abril" ||
        $valores[0]['Datos'][0]['Periodo']=="Mayo" || $valores[0]['Datos'][0]['Periodo']=="Junio" || $valores[0]['Datos'][0]['Periodo']=="Julio" || $valores[0]['Datos'][0]['Periodo']=="Agosto" || 
        $valores[0]['Datos'][0]['Periodo']=="Septiembre" || $valores[0]['Datos'][0]['Periodo']=="Octubre" || $valores[0]['Datos'][0]['Periodo']=="Noviembre" ||
        $valores[0]['Datos'][0]['Periodo']=="Diciembre" )
                @for($j=0 ; $j<count($valores[0]['Datos']) ; $j++ )
                    <td  align="center">{{ $valores[0]['Datos'][$j]['Periodo'] }}</td>
                @endfor
        @endif

        @if($valores[0]['Datos'][0]['Periodo']=="T1" || $valores[0]['Datos'][0]['Periodo']=="T2" 
        || $valores[0]['Datos'][0]['Periodo']=="T3" || $valores[0]['Datos'][0]['Periodo']=="T4" )
        @foreach($años as $año)
                @foreach($periodos as $periodo)
                    <td>{{ $periodo }}</td>
                @endforeach
        @endforeach
        @endif
    </tr>
    @for($i=0 ; $i<count($valores) ; $i++ )
    <tr  bgcolor= "#01A556" style="color:White;">
    <th>{{$valores[$i]['Nombre']}}</th>
      @for($j=0 ; $j<count($valores[$i]['Datos']) ; $j++ )
          <td>{{ $valores[$i]['Datos'][$j]['Valor'] }}</td>
      @endfor
      </tr>

    @endfor

    @else
    <tr  bgcolor= "#01A556" style="color:White;">
    @for($j=0 ; $j<count($valores[0]['Datos']) ; $j++ )
         <th>{{ $valores[0]['Datos'][$j]['Valor'] }}</th>
    @endfor
    </tr>
    @endif

    </thead>
    </table>
</div>


 