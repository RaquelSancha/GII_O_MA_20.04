@extends('adminlte::layouts.app')


@section('main-content')


<div class="container">
<br><br><br>
	<div class="row div_margin">
    <div class="col-md-3 col-sm-6 col-xs-12 cut_box1">
      <div class="cut_box1a"> 

        <p class="rouded_text"></p>
      </div>
    </div>
    <!-- /.col-lg-4 -->

    <div class="col-md-3 col-sm-6 col-xs-12 cut_box2">
      <div class="cut_box2a"><i class="fa fa-pencil-square-o fa-5x " aria-hidden="true"></i>
      <p></p>
      <a class="rouded_text" href="{{ url('/form/new') }}" >Insertar tabla<br>
          con valores nuevos</a>    
      </div>
    </div>
    <!-- /.col-lg-4 -->
    <div class="col-md-3 col-sm-6 col-xs-12 cut_box3">
      <div class="cut_box3a"><i class="fa fa-pencil-square fa-5x " aria-hidden="true"></i>
      <p></p>
        <a class="rouded_text" href="{{ url('/form/create') }}">Crear tabla<br>
     	a partir de categorías existentes</a>
      </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12 cut_box4">
      <div class="cut_box4a">
        <p class="rouded_text"><br>
          </p>
      </div>
    </div>
    <!-- /.col-lg-4 --> 
  </div>

</div>
@endsection
