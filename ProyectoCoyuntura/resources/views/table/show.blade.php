@extends('adminlte::layouts.app')


@section('main-content')
<h2><b>Tablas</b> Predefinidas</h1><hr>
@include('table.table')
<div align="right">
<a href="{{ url('tables')}}/{{$id}}/{{'edit'}}" class="btn btn-primary btn-lg active" role="button">Modificar Valores</a>
</div>
<div class="box">
	<div class="box-header with-border">
		<h3 class="box-title">Bienvenido!</h3>

		<div class="box-tools pull-right">
			<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
				<i class="fa fa-minus"></i></button>
			<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
				<i class="fa fa-times"></i></button>
		</div>
	</div>
	<div class="box-body">
		   <canvas id="myChart" height="40vh" width="80vw"></canvas>
		 </div>

	<!-- /.box-body -->
</div>
		


<script>

  $(document).ready(function($categoria) {
  
    var ctx = document.getElementById("myChart");
            var myChart = new Chart(ctx, {
                type: 'horizontalBar',
                data: {
                    labels: [],
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
                            'rgba(255,99,132,1)',
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
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });
});


</script>
@endsection
