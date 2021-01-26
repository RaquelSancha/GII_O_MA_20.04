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
<div class="register-box-body">
    <p class="login-box-msg">Inicia sesión</p>

                
            <form id="surveyForm" method="post" class="form-horizontal" action="{{ url('/loginUsuarios') }}">
            {{ csrf_field() }}
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
                                <input type="password" name="password" class="form-control"  required placeholder="{{ trans('adminlte_lang::message.password') }}">
                        </div>
                    </div>
                </div>
                @if(isset($errorPass))
                    @if($errorPass=='true')
                    <FONT COLOR="red">La contraseña o el email no son correctos</FONT><br>
                    @endif
                @endif
               
                <div class="form-group">
                    <div class="col-md-8 col-md-offset-4">
                        <input type="submit" value="Acceder" class="btn btn-primary"  > 
                    </div>
                </div>
            </form>

            <a href="{{ url('/register') }}" class="text-center">{{ trans('adminlte_lang::message.registermember') }}</a>
            </div><!-- /.form-box -->
        </div><!-- /.register-box -->
    </div>
    @include('adminlte::layouts.partials.scripts_auth')

@include('adminlte::auth.terms')
</body>
@endsection


