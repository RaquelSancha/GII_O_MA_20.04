<!-- Main Header -->
<header class="main-header">

    <!-- Logo -->

     @if (Auth::guest())
    <a href="{{ url('/homeGuest') }}" class="logo">
    @else
    <a href="{{ url('/home') }}" class="logo">
    @endif
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>P</b>C</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Proyecto</b>Coyuntura </span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">{{ trans('adminlte_lang::message.togglenav') }}</span>
        </a>
        <div align="center">
        <a href="http://fundacioncajaruralburgos.es/" target="_blank">
            <img src="{{url('img/cajavivaicon.png')}}"  width="14">
        </a>
        &nbsp; &nbsp; &nbsp;
        <a href="http://www.ubu.es/" target="_blank">
            <img src="{{url('img/ubu.png')}}"  width="27">
        </a> 


        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
               
                       
                @if (Auth::guest())
                    <li><a href="{{ url('/register') }}">{{ trans('adminlte_lang::message.register') }}</a></li>
                    <li><a href="{{ url('/login') }}">{{ trans('adminlte_lang::message.login') }}</a></li>
                @else
                    <!-- User Account Menu -->
                    <li class="dropdown user user-menu" id="user_menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- The user image in the navbar-->
                            <img src="{{ Gravatar::get($user->email) }}" class="user-image" alt="User Image"/>
                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- The user image in the menu -->
                            <li class="user-header">
                                <img src="{{ Gravatar::get($user->email) }}" class="img-circle" alt="User Image" />
                                <p>
                                    {{ Auth::user()->name }}
                                    <small>Miembro desde: {{ Auth::user()->created_at }}</small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                            <div align="left">
                                    <a href="{{ url('/user/editarPerfil')}}/{{Auth::user()->id}}" class="btn btn-default btn-flat" id="editar">Editar perfil</a>
                            </div>
                                <div align="right">
                                    <a href="{{ url('/logout') }}" class="btn btn-default btn-flat" id="logout"
                                       onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        {{ trans('adminlte_lang::message.signout') }}
                                    </a>

                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                        <input type="submit" value="logout" style="display: none;">
                                    </form>

                                </div>
                            </li>
                        </ul>
                    </li>
                @endif

               
            </ul>
        </div>
        </div>
    </nav>
</header>
