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
						<h3 class="box-title">Bienvenido</h3>
					</div>
					<div class="box-body">
						<div align="justify">
						El Proyecto Coyuntura tiene como objetivo elaborar una herramienta web dinámica que,
						a partir de diferentes fuentes de datos relacionados con la coyuntura económica de Burgos
						(hojas de cálculo, bases de datos o directamente de las páginas del INE, Banco de España, EUROSTAT,
						Sistema de Información Estadística de Castilla y León, etc..), almacene dichos datos, permita su tratamiento 
						y adecue su posterior presentación a las necesidades de los usuarios.
						</div>

						<br><br>
						<div align="center">
						<img src="img/cajaviva.png" width="270">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<img src="img/ubu.jpg" width="270">
						</div>
						<br>
					</div>
					
				</div>

				



			</div>
		</div>
	</div>


@endsection
