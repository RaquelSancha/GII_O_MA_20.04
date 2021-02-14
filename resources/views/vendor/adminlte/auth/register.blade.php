@extends('adminlte::layouts.auth')

@section('htmlheader_title')
    Register
@endsection

@section('content')

<body class="hold-transition register-page">
    <div id="app" v-cloak>
        <div class="register-box">
            <div class="register-logo">
                <a href="{{ url('/home') }}"><b>Proyecto</b>Coyuntura</a>
            </div>

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> {{ trans('adminlte_lang::message.someproblems') }}<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="register-box-body">
                <p class="login-box-msg">Rellena el formulario para solicitar al administrador registrarse en la aplicación</p>

                
            <form id="surveyForm" method="post" class="form-horizontal" action="{{ url('/register/solicitud') }}">
              {{ csrf_field() }}
                <div class="form-group">
                    <label for="nombre_variable" class="col-md-2 control-label"></label>
                    <div class="row">
                        <div class="input-group col-md-8">
                                <span class="input-group-addon"><i class="fa fa-user-o fa-fw"></i></span>
                                <input type="text" name="nombre" class="form-control" required placeholder="{{ trans('adminlte_lang::message.fullname') }}">

                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="nombre_variable" class="col-md-2 control-label"></label>
                    <div class="row">
                        <div class="input-group col-md-8">
                                <span class="input-group-addon"><i class="fa fa-envelope-o fa-fw"></i></span>
                                <input type="email" name="email" class="form-control" required placeholder="{{ trans('adminlte_lang::message.email') }}">

                        </div>
                    </div>
                </div>
                 <div class="form-group">
                    <label for="nombre_variable" class="col-md-2 control-label"></label>
                    <div class="row">
                        <div class="input-group col-md-8">
                                <span class="input-group-addon"><i class="fa fa-unlock-alt  fa-fw"></i></span>
                                <input type="password" name="password" class="form-control" pattern="[A-Za-z0-9!?-]{8,16}" required placeholder="{{ trans('adminlte_lang::message.password') }}">

                        </div>
                    </div>
                </div>
                 <div class="form-group">
                    <label for="nombre_variable" class="col-md-2 control-label"></label>
                    <div class="row">
                        <div class="input-group col-md-8">
                                <input type="password" name="repassword" class="form-control" pattern="[A-Za-z0-9!?-]{8,16}" required placeholder="{{ trans('adminlte_lang::message.retypepassword') }}">

                        </div>
                       
                    </div>
                    <small>*La contraseña debe tener como mínimo 8 caracteres</small>
                </div>
                @if(isset($errorPass))
                    @if($errorPass==true)
                    <FONT COLOR="red">Las contraseñas no coinciden.</FONT><br>
                    @endif
                @endif
                @if(isset($errorNombreEmail))
                    @if($errorNombreEmail==true)
                    <FONT COLOR="red">El email o el nombre de usuario ya existen.</FONT><br>
                    @endif
                @endif
                <div class="form-group">
                    <div class="col-md-8 col-md-offset-4">
                        <input type="submit" value="Registrame" class="btn btn-primary"  > 
                    </div>
                </div>
            </form>

                <a href="{{ url('/login') }}" class="text-center">{{ trans('adminlte_lang::message.membreship') }}</a>
            </div><!-- /.form-box -->
        </div><!-- /.register-box -->
    </div>

    @include('adminlte::layouts.partials.scripts_auth')

    @include('adminlte::auth.terms')

</body>

@endsection
