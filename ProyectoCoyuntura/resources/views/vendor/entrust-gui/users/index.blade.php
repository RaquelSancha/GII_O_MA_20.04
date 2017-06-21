@extends('adminlte::layouts.app')

@section('heading', 'Users')
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
        <form action="{{ route('entrust-gui::users.destroy', $user->id) }}" method="post">
          <input type="hidden" name="_method" value="DELETE">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <a class="btn btn-labeled btn-default" href="{{ route('entrust-gui::users.edit', $user->id) }}"><span class="btn-label"><i class="fa fa-pencil"></i></span>{{ trans('entrust-gui::button.edit') }}</a>
          <button type="submit" class="btn btn-labeled btn-danger"><span class="btn-label"><i class="fa fa-trash"></i></span>{{ trans('entrust-gui::button.delete') }}</button>
        </form>
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
  @foreach($usersConfirm as $user)
    <tr>
      <td>{{ $user->email }}</th>
      <?php $id=$user->id ?>
      <td class="col-xs-3">
          <a class="btn btn-labeled btn-success" href="/register/aceptar/{{$id}}"><span class="btn-label">Aceptar</a>
          <a class="btn btn-labeled btn-danger" href="/register/declinar/{{$id}}"><span class="btn-label">Declinar</a>
      </td>
    </tr>
  @endforeach
</table>
<div class="text-center">
  {!! $users->render() !!}
</div>
@endsection
