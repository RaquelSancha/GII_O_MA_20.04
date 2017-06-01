@extends('adminlte::layouts.app')


@section('main-content')
<h2>Crear Tablas:  <b>{{$variable}}</b></h1><hr>
@include('table.table')
<form class="form-horizontal" role="form" method="POST" action="{{ url('confirm/save')}}" >
    {{ csrf_field() }}

    <div class="form-group">
     <label for="categoria" class="col-md-4 control-label"></label>
      <div class="col-md-2">

      <script type="text/javascript">
        $(document).ready(function(){

          $("#btn-guardar").click(function(){
            var params ={
                categorias: $categoria,
                years: $year
            }
             $.ajax({
            url: Table.save,
            type: "post",
            data: params,
            success: function (result) {

            }
        
            });
          });

        });
      </script>
      
      </div>
    </div>

  
  <div>
    <input class="btn btn-success" value="Guardar Tabla" id="btn-guardar" />
  </div>
</form>
@endsection
