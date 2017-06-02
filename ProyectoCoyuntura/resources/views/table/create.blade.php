@extends('adminlte::layouts.app')


@section('main-content')
<h2>Crear Tablas:  <b>{{$variable}}</b></h1><hr>
@include('table.table')

<div>
    <a class= "btn btn-success" href="javascript:history.back(-1);" role="button">Volver</a>
    <a class="btn btn-success"  id="btn-guardar" role="button" />Guardar </a>
</div>

<script type="text/javascript">
 $(document).on('ready',function(){

      $('#btn-iguardar').click(function(){
        var url = "confirm/save";                                      

        $.ajax({                        
           type: "POST",                 
           url: url,                    
           data: $("#formulario").serialize(),
           success: function(data)            
           {
             $('#resp').html(data);           
           }
         });
      });
  });
</script>

@endsection
