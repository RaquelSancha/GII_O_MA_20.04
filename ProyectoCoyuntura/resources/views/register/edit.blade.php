@extends('adminlte::layouts.app')


@section('main-content')

<div class="box">
  <div class="box-header with-border">
    <h3 class="box-title">Editar usuario "{{$user->name}}"</h3>
  </div>
  <div class="box-body">      
    
<form class="form-horizontal" role="form" method="POST" action="{{ url('/confirm/user/edit')}}/{{$id}}">
  {{ csrf_field() }}

   
      <div class="form-group">
         <label for="rol" class="col-md-4 control-label"> Roles</label>
         <div class="row">
            <div class="form-group form-group-options col-md-4 col-md-offset-5">              
              <select class="selectpicker" data-live-search="true"  data-actions-box="true" name="roles" title="">
              @for ($l = 0; $l < count($roles); $l++)                 
               <option>{{$roles[$l]->name }}</option>
               @endfor
              </select>
           </div>
        </div>
      </div>
    <div class="form-group">
          <div class="col-md-8 col-md-offset-4">
              <input type="submit" value="Modificar" onclick="return confirm('Se modificarán los valores de la Base de datos,¿Estás seguro?')" class="btn btn-primary"  > 
          </div>
      </div>
 
@endsection

