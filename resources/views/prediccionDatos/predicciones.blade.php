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
		   <canvas id="myChart" height="40vh" width="80vw"></canvas>
		 

       <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js">
     </script>

     <script>
var ctx = document.getElementById('myChart');
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
        datasets: [{
            label: '# of Votes',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
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
