@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection


@section('main-content')
	<div class="container-fluid spark-screen">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">

				<!-- Default box -->
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
						El Proyecto Coyuntura tiene como objetivo elaborar una herramienta web dinámica que,
						a partir de diferentes fuentes de datos relacionados con la coyuntura económica de Burgos
						(hojas de cálculo, bases de datos o directamente de las páginas del INE, Banco de España, EUROSTAT,
						Sistema de Información Estadística de Castilla y León, etc..), almacene dichos datos, permita su tratamiento 
						y adecue su posterior presentación a las necesidades de los usuarios.
					</div>
					<!-- /.box-body -->
				</div>

				<div class="row">
						<canvas id="myChart" width="400" height="400"></canvas>
				</div>




			</div>
		</div>
	</div>


<script>

	$(document).ready(function() {
  
  	var ctx = document.getElementById("myChart");
						var myChart = new Chart(ctx, {
						    type: 'bar',
						    data: {
						        labels: ["Red", "Blue", "Yellow", "Green", "Purple", "Orange"],
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
