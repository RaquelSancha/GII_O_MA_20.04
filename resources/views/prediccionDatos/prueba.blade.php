@extends('adminlte::layouts.app')
@section('main-content')
<?php $asterisco=0;?>
<h2><b>Predicciones de la variable "{{ $nombreVariable }}"</b></h1><hr>
<div class="box">
<div class="table-responsive">
<h1> PREDICCIONES </h1>
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

<div class="table-responsive">
<h1> VALORES REALES </h1>
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
            @for ($i = 0; $i < count($valoresReales); $i++)
                <td>{{$valoresReales[$i]}}</td>
            @endfor
          </tr>  
    </tbody>
</table>
</div>

<div class="box-body">
		   <canvas id="myChart" height="40vh" width="80vw" aria-label="Hello ARIA World" role="img"></canvas>
		 </div>
     </div>	 


<script type="text/javascript">
    $(document).ready(function($predicciones, $valoresReales) {

var ctx = document.getElementById('myChart');

var myChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: ["Enero ","Febrero ","Marzo ","Abril ","Mayo ","Junio ","Julio ","Agosto ","Septiembre ","Octubre ","Noviembre ","Diciembre "],
        datasets: [
          
          {
            label: 'Valores reales',
            data: [ @for($i=0 ; $i<count($valoresReales);$i++) {{$valoresReales[$i]}},  @endfor],
            borderColor: "#FF3333",
            borderWidth: 1
        },

        {
          label: 'Predicción',
            data: [ @for($i=0 ; $i<count($predicciones);$i++) {{$predicciones[$i]}}, @endfor  ],
            borderColor: "#357ebd",
            borderWidth: 1

        }
        
        
        ]
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
    });
</script>



@endsection
