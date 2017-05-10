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
				<!-- /.box -->

			</div>
		</div>
	</div>
@endsection
