@extends('adminlte::layouts.app')


@section('main-content')


<div class="container">
<br><br><br>
	<div class="row div_margin">
    <div class="col-md-3 col-sm-6 col-xs-12 cut_box1">
      <div class="cut_box2a"><i class="fa fa-bar-chart fa-5x " aria-hidden="true"></i>
      <p></p>
      <a class="rouded_text" href="{{ url('/datosINE/subirdatos') }}" >Subir datos desde el INE<br>
        </a>    
      </div>
    </div>
    <!-- /.col-lg-4 -->

    <div class="col-md-3 col-sm-6 col-xs-12 cut_box2">
      <div class="cut_box2a"><i class="fa fa-list-alt fa-5x " aria-hidden="true"></i>
      <p></p>
      <a class="rouded_text" href="{{ url('/datosINE/actualizar') }}" >Actualizar datos<br>
         </a>    
      </div>
    </div>
    
    <!-- /.col-lg-4 --> 
  </div>

</div>
@endsection
