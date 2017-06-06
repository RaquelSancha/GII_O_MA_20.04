@extends('adminlte::layouts.app')


@section('main-content')


<div class="container">
<br><br><br>
	<div class="row div_margin">
    <div class="col-md-3 col-sm-6 col-xs-12 cut_box1">
      <div class="cut_box2a"><i class="fa fa-bar-chart fa-5x " aria-hidden="true"></i>
      <p></p>
      <a class="rouded_text" href="{{ url('/data/index/variables') }}" >Mostrar<br>
          variables</a>    
      </div>
    </div>
    <!-- /.col-lg-4 -->

    <div class="col-md-3 col-sm-6 col-xs-12 cut_box2">
      <div class="cut_box2a"><i class="fa fa-list-alt fa-5x " aria-hidden="true"></i>
      <p></p>
      <a class="rouded_text" href="{{ url('/data/variables') }}" >Mostrar<br>
          super categorías</a>    
      </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12 cut_box4">
      <div class="cut_box3a"><i class="fa fa-bookmark-o fa-5x " aria-hidden="true"></i>
      <p></p>
        <a class="rouded_text" href="{{ url('/data/ambitos') }}">Mostrar<br>
      categorías</a>
      </div>
    </div>
        <div class="col-md-3 col-sm-6 col-xs-12 cut_box3">
      <div class="cut_box3a"><i class="fa fa-globe fa-5x " aria-hidden="true"></i>
      <p></p>
        <a class="rouded_text" href="{{ url('/data/ambitos') }}">Mostrar<br>
     	ámbitos geográficos</a>
      </div>
    </div>
    
    <!-- /.col-lg-4 --> 
  </div>

</div>
@endsection
