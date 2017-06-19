<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        @if (! Auth::guest())
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{ Gravatar::get($user->email) }}" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('adminlte_lang::message.online') }}</a>
                </div>
            </div>
        @endif

       
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">MENÚ</li>
            <!-- Optionally, you can add icons to the links -->

            @if (Auth::guest())
            <li><a href="{{ url('/homeGuest') }}"><i class='fa fa-link'></i> <span>{{ trans('adminlte_lang::message.home') }}</span></a></li>
            @else
            <li><a href="{{ url('/home') }}"><i class='fa fa-link'></i> <span>{{ trans('adminlte_lang::message.home') }}</span></a></li>
            @endif

            <li ><a href="{{ url('data/choose') }}"><i class='fa fa-database'></i> <span>Gestión Datos</span></a></li>
            <li class="treeview">
                <a href="#"><i class='fa fa-table'></i> <span>{{ trans('adminlte_lang::message.tables') }}</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    
                    <li><a href="{{ url('/tables') }}"><i class='fa fa-list'></i>{{ trans('adminlte_lang::message.predefinedTables') }}</a></li>
                    <li><a href="{{ url('/form/choose') }}"><i class='fa fa-plus'></i>{{ trans('adminlte_lang::message.createTable') }}</span></a></li>
                </ul>
            </li>
            
            <li class="treeview">
                <a href="#"><i class='fa fa-edit'></i> <span>{{ trans('adminlte_lang::message.administration') }}</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <!--<li><a href="{{ url('/admin/roles') }}">{{ trans('adminlte_lang::message.roles') }}</a></li>
                    <li><a href="{{ url('/admin/permissions') }}">{{ trans('adminlte_lang::message.permissions') }}</a></li>-->
                    <li><a href="{{ url('/admin/users') }}"><i class='fa fa-user-o'></i>{{ trans('adminlte_lang::message.users') }}</span></a></li>
                </ul>
            </li>
            @if (Auth::guest())
                <li ><a href="{{ url('/helpGuest') }}"><i class='fa fa-info'></i> <span>Ayuda</span></a></li>
            @else
                <li ><a href="{{ url('/help') }}"><i class='fa fa-info'></i> <span>Ayuda</span></a></li>
            @endif
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
