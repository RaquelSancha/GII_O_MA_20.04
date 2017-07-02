@extends('adminlte::layouts.app')


@section('main-content')

<div class="box">
	<div class="box-header with-border">
		<h3 class="box-title">Selecciona las categorías que deseas borrar</h3>
	</div>
	<div class="box-body">			
		
<form class="form-horizontal" role="form" method="POST" action="{{ url('/confirm/deleteCategoria')}}/{{$id}}">
  {{ csrf_field() }}

   <div class="form-group">
      <label for="categoria" class="col-md-4 control-label">Selecciona las categorías</label>
      <div class="col-md-2">
          <select multiple data-actions-box="true" data-live-search="true" data-width="auto" class="selectpicker show-tick dropup" required name="categoria[]" title="" >
            @for($i=0, $j=0 ;$i<count($categorias);$i++)
            @if(!(empty($supercategorias[$j]->Name)))
              @if($categorias[$i]->idSuperCategoria == $supercategorias[$j]->idSuperCategoria)
                 <optgroup label="{{$supercategorias[$j]->Name}}" >
                 <?php  $j++; ?>
              @endif
            @endif
            <option>{{$categorias[$i]->Nombre}}</option>
            @endfor
          </select>
      </div>
  </div>
  <div class="form-group">
      <div class="col-md-8 col-md-offset-4">
         <input type="submit" value="Borrar" class="btn btn-primary"  > 
      </div>
  </div>

</div>
@endsection