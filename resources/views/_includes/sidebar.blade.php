<!-- Left Sidebar -->
<aside id="leftsidebar" class="sidebar">
    <!-- User Info -->
    <div class="user-info">
        <div class="image">
            @if(auth()->user()->photo == null)
            <img src="{{ asset('assets/images/avater.png') }}" width="48" height="48" alt="User" /> @else
            <img src="{{ asset('uploads/users/'.auth()->user()->photo) }}" width="48" height="48" alt="User" /> @endif
        </div>
        <div class="info-container">
            <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ auth()->user()->user_name }}
            </div>
            <div class="email">{{ auth()->user()->email }}</div>
            <div class="btn-group user-helper-dropdown">
                <i class="material-icons" id="drop" aria-expanded="true">keyboard_arrow_down</i>

                <ul class="pull-right dropdown-menu">
                    <li><a href="{{ route('users.show',auth()->user()->id) }}"><i class="material-icons">person</i>Profile</a></li>
                    <li role="seperator" class="divider"></li>
                    <li>
                        <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    <i class="material-icons">input</i> Log Out
                    </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <!-- #User Info -->
    <!-- Menu -->
    <div class="menu">
        <ul class="list">
            <li class="header">MAIN NAVIGATION</li>
            <!--easy nav packace use for navbar active-->
            <li class="{{ Nav::isRoute('admin') }}"> <a href="{{ route('admin') }}">
             <i class="material-icons">add_to_queue</i>
                <span>Dashboard</span> </a> </li>
            @permission('create-generals',Auth::user())
            <li class="{{ Nav::isRoute('general-setting') }}"> <a href="{{ route('general-setting.index') }}">
             <i class="fa fa-cogs"></i>
                <span>General Setting</span> </a> </li>
            @endpermission @permission('fuels-index',Auth::user())
            <li class="{{ Nav::isRoute('fuels') }}"> <a href="{{ route('fuels.index') }}">
             <i class="material-icons">brightness_4</i>
                <span>Fuels</span> </a> </li>
            @endpermission @permission('plants-index',Auth::user())
            <li class="{{ Nav::isRoute('powers') }}"> <a href="{{ route('powers.index') }}">
               <i class="material-icons">gamepad</i>
                <span>Powers Plant</span> </a> </li>
            @endpermission @permission('infos-index',Auth::user())
            <li class="{{ Nav::isRoute('power-info') }}"> <a href="{{ route('power-info.index') }}">
                <i class="material-icons">stars</i>
                <span>Powers info (popup)</span> </a> </li>
            @endpermission @permission('distributions-index',Auth::user())
            <li class="{{ Nav::isRoute('distributions') }}"> <a href="{{ route('distributions.index') }}">
                <i class="material-icons">import_export</i>
                <span>Distribution</span> </a> </li>
            @endpermission @permission('create-capacities',Auth::user())
            <li class="{{ Nav::isRoute('total-capacity') }}"> <a href="{{ route('total-capacity.index') }}">
              <i class="material-icons">group_work</i>
                <span>Total Capacity</span> </a> </li>
            @endpermission @permission('manuals-index',Auth::user())
            <li class="{{ Nav::isRoute('manuals') }}"> <a href="{{ route('manuals.index') }}">
              <i class="fa fa-cross"></i>
                <span>Manual Capacity</span> </a> </li>
            @endpermission @permission('sliders-index',Auth::user())
            <li class="{{ Nav::isRoute('slider') }}"> <a href="{{ route('slider.index') }}">
                <i class="material-icons">Slider</i>
                <span>Slider</span> </a> </li>
            @endpermission @permission(['options-index','maps-index'])
            <li class="{{ Nav::isResource('map-option') }} {{ Nav::isResource('map-info') }}">
                <a href="javascript:void(0); " class="menu-toggle">
                                    <i class=" zmdi zmdi-delicious "></i><span>Map</span> </a>
                <ul class="ml-menu ">
                    @permission('options-index',Auth::user())
                    <li> <a href="{{ route( 'map-option.index') }} ">Map Options</a></li>
                    @endpermission @permission('maps-index',Auth::user())
                    <li> <a href="{{ route( 'map-info.index') }}">Map Markers</a></li>
                    @endpermission
                </ul>
            </li>
            @endpermission @permission('users-index',Auth::user())
            <li class="{{ Nav::isResource('users') }}"><a href="{{ route('users.index') }}">
                    <i class="fa fa-users"></i>
                    <span>Users</span>
             </a> </li>
            @endpermission @permission('roles-index',Auth::user())
            <li class="{{ Nav::isResource('roles') }}"><a href="{{ route('roles.index') }}">
                    <i class="fa fa-user-secret"></i>
                    <span>Roles</span>
             </a> </li>
            @endpermission @if(Auth::user()->hasRole('developer'))
            <li class="{{ Nav::isResource('permissions') }}"><a href="{{ route('permissions.index') }}">
                    <i class="fa fa-deaf"></i>
                    <span>Permissions</span>
             </a> </li>
            @endif
        </ul>
    </div>
    <!-- #Menu -->
</aside>