@extends('adminlte::layouts.app')


@section('main-content')


<div class="container">
<br><br><br>
	<div class="row div_margin">
    <div class="col-md-3 col-sm-6 col-xs-12 cut_box1">
      <div class="cut_box2a">
      <p></p>
      <a class="rouded_text" href="" ><br>
         </a>    
      </div>
    </div>
    <!-- /.col-lg-4 -->

    <div class="col-md-3 col-sm-6 col-xs-12 cut_box2">
      <div class="cut_box2a"><i class="fa fa-exclamation-triangle fa-5x " aria-hidden="true"></i>
      <p></p>
      <a class="rouded_text" href="{{ url('data/delete/categorias/full')}}/{{$id}}" >Borrar<br>
          de la aplicación</a>    
      </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12 cut_box4">
      <div class="cut_box3a"><i class="fa fa-trash-o fa-5x " aria-hidden="true"></i>
      <p></p>
        <a class="rouded_text" href="{{ url('/data/delete/categorias/variable')}}/{{$id}}">Borrar<br>
      de una tabla</a>
      </div>
    </div>
        <div class="col-md-3 col-sm-6 col-xs-12 cut_box3">
      <div class="cut_box3a">
      <p></p>
        <a class="rouded_text" href=""><br></a>
      </div>
    </div>
    
    <!-- /.col-lg-4 --> 
  </div>

</div>
@endsection
