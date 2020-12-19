@extends('adminlte::layouts.app')

@section('heading', 'Users','Usersconfirm')
@section('main-content')
<h2><b>Usuarios</b> del sistema</h1><hr>

<table class="table table-striped">
  <tr>
    <th>Email</th>
    <th>{{ trans('adminlte_lang::message.actions') }}</th>
  </tr>
  @foreach($users as $user)
    <tr>
      <td>{{ $user->email }}</th>

      <td class="col-xs-3">
      <?php $id=$user->id ?>
         <a class="btn btn-labeled btn-success" href="/register/editar/{{$id}}"><span class="btn-label">Editar</a>
          <a class="btn btn-labeled btn-danger" href="/register/borrar/{{$id}}"><span class="btn-label">Borrar</a>
      </td>
    </tr>
  @endforeach
</table>
<h2><b>Solicitudes</b> de creación de cuenta </h1><hr>
<table class="table table-striped">
  <tr>
    <th>Email</th>
    <th>{{ trans('adminlte_lang::message.actions') }}</th>
  </tr>
  @foreach($usersconfirm as $userconf)
    <tr>
      <td>{{ $userconf->email }}</th>
      <?php $id=$userconf->id ?>
      <td class="col-xs-3">
          <a class="btn btn-labeled btn-success" href="/register/aceptar/{{$id}}"><span class="btn-label">Aceptar</a>
          <a class="btn btn-labeled btn-danger" href="/register/declinar/{{$id}}"><span class="btn-label">Declinar</a>
      </td>
    </tr>
  @endforeach
</table>
<div class="text-center">

</div>
@endsection
