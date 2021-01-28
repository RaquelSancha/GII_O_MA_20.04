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
            @for ($i = 0; $i < count($prediccionesExtraTree); $i++)
                <td>{{ $prediccionesExtraTree[$i] }}</td>
            @endfor
          </tr>  
    </tbody>
</table>
</div>

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
            @for ($i = 0; $i < count($prediccionesGradientB); $i++)
                <td><?php echo (float)$prediccionesGradientB[$i]; ?></td>
            @endfor
          </tr>  
    </tbody>
</table>
</div>
		   <canvas id="myChart" height="400" width="400"></canvas>
		 

       <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js">
     </script>

     <script>
var ctx = document.getElementById('myChart');
var myChart = new Chart(ctx, {
    type: 'Lineas',
    data: {
      labels: ["Enero ","Febrero ","Marzo ","Abril ","Mayo ","Junio ","Julio ","Agosto ","Septiembre ","Octubre ","Noviembre ","Diciembre "],
        datasets: [
                                @for($l=0; $l<count($ambitosForm);$l++)
                                    @for($i=0 ; $i<count($categoriasForm);$i++)
                                         @for($j=0; $j<count($yearsForm);$j++)
                                                <?php $red =rand(0,255) ;$green =rand(0,255) ;$blue =rand(0,255); ?>
                                            {
                                                label: '{{$categoriasForm[$i]}} {{$yearsForm[$j]}} ({{$ambitosForm[$l]}})',

                                                
                                                data: [
                                                @if(!(empty($valuesForm[$l][($i*count($yearsForm))+$j][0][0]->valor)))
                                                {{$valuesForm[$l][($i*count($yearsForm))+$j][0][0]->valor}},
                                                @else
                                                ,
                                                @endif
                                                @if(!(empty($valuesForm[$l][($i*count($yearsForm))+$j][1][0]->valor)))
                                                {{$valuesForm[$l][($i*count($yearsForm))+$j][1][0]->valor}},
                                                @else
                                                ,
                                                @endif
                                                @if(!(empty($valuesForm[$l][($i*count($yearsForm))+$j][2][0]->valor)))
                                                {{$valuesForm[$l][($i*count($yearsForm))+$j][2][0]->valor}},
                                                @else
                                                ,
                                                @endif
                                                @if(!(empty($valuesForm[$l][($i*count($yearsForm))+$j][3][0]->valor)))
                                                {{$valuesForm[$l][($i*count($yearsForm))+$j][3][0]->valor}},
                                                @else
                                                ,
                                                @endif
                                                @if(!(empty($valuesForm[$l][($i*count($yearsForm))+$j][4][0]->valor)))
                                                {{$valuesForm[$l][($i*count($yearsForm))+$j][4][0]->valor}},
                                                @else
                                                ,
                                                @endif
                                                @if(!(empty($valuesForm[$l][($i*count($yearsForm))+$j][5][0]->valor)))
                                                {{$valuesForm[$l][($i*count($yearsForm))+$j][5][0]->valor}},
                                                @else
                                                ,
                                                @endif
                                                @if(!(empty($valuesForm[$l][($i*count($yearsForm))+$j][6][0]->valor)))
                                                {{$valuesForm[$l][($i*count($yearsForm))+$j][6][0]->valor}},
                                                @else
                                                ,
                                                @endif
                                                @if(!(empty($valuesForm[$l][($i*count($yearsForm))+$j][7][0]->valor)))
                                                {{$valuesForm[$l][($i*count($yearsForm))+$j][7][0]->valor}},
                                                @else
                                                ,
                                                @endif
                                                @if(!(empty($valuesForm[$l][($i*count($yearsForm))+$j][8][0]->valor)))
                                                {{$valuesForm[$l][($i*count($yearsForm))+$j][8][0]->valor}},
                                                @else
                                                ,
                                                @endif
                                                @if(!(empty($valuesForm[$l][($i*count($yearsForm))+$j][9][0]->valor)))
                                                {{$valuesForm[$l][($i*count($yearsForm))+$j][9][0]->valor}},
                                                @else
                                                ,
                                                @endif
                                                @if(!(empty($valuesForm[$l][($i*count($yearsForm))+$j][10][0]->valor)))
                                                {{$valuesForm[$l][($i*count($yearsForm))+$j][10][0]->valor}},
                                                @else
                                                ,
                                                @endif
                                                @if(!(empty($valuesForm[$l][($i*count($yearsForm))+$j][11][0]->valor)))
                                                {{$valuesForm[$l][($i*count($yearsForm))+$j][11][0]->valor}},
                                                @else
                                                ,
                                                @endif
                                                 ],
                                                
                                                 borderColor: [
                                                    @for($aux=0 ; $aux<12 ; $aux++)
                                                    "rgba({{$red}},{{$green}},{{$blue}}, 1)",
                                                    @endfor

                                                ],
                                                backgroundColor: [
                                                    @for($aux=0 ; $aux<12 ; $aux++)
                                                    "rgba({{$red}},{{$green}},{{$blue}}, 0.2)",
                                                    @endfor

                                                ],
                                            },
                                        @endfor
                                    @endfor
                                @endfor]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>




@endsection
