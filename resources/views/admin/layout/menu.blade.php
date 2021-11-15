<ul class="sidebar-menu scrollable pos-r">
    @if(isset($menus))
        @foreach($menus as $menu)
            <li class="nav-item dropdown {{ Request::is(config("app.route_admin").'/'.$menu->menu_href. '*') ? 'open' : '' }}">
                @if(!$menu->menu_list || !$menu->menu_add)
                <a class="sidebar-link"
                   href="{{ route($menu->menu_href) }}">
                    <span class="icon-holder"><i class="{{$menu->menu_color}} {{$menu->menu_icon}}"></i> </span>
                    <span class="title">{{ $menu->menu_title }}</span>
                </a>
                @endif
                @if($menu->menu_list || $menu->menu_add)
                    <a class="dropdown-toggle nav-parent {{ Request::is(config("app.route_admin").'/'.$menu->menu_href) ? 'active' : '' }}">
                        <span class="icon-holder"><i class="{{$menu->menu_color}} {{$menu->menu_icon}}"></i> </span>
                        <span class="title">{{ $menu->menu_title }}</span>
                        <span class="arrow"><i class="ti-angle-right"></i></span>
                    </a>
                    <ul class="dropdown-menu">
                        @if($menu->menu_list)
                            <li class="nav-child {{ Request::is(config("app.route_admin").'/'.$menu->menu_href) ? 'active' : '' }}">
                                <a class="sidebar-link" href="{{ route($menu->menu_href.".list") }}">
                                    <i class="fa fa-circle"></i> Danh Sách {{$menu->menu_title}}
                                </a>
                            </li>
                        @endif
                        @if($menu->menu_add)
                            <li class="nav-child {{ Request::is(config("app.route_admin").'/'.$menu->menu_href.'/add') || Request::is(config("app.route_admin").'/'.$menu->menu_href.'/edit/*') ? 'active' : '' }}">
                                <a class="sidebar-link" href="{{ route($menu->menu_href.".add") }}">
                                    <i class="fa fa-circle"></i> Thêm {{$menu->menu_title}}
                                </a>
                            </li>
                        @endif
                    </ul>
                @endif
            </li>
        @endforeach
    @endif

    <li class="nav-item nav-parent">
        <a class="sidebar-link"
           href="{{route("admin.logout")}}" onclick="document.getElementById('logout-form').submit();">
            <span class="icon-holder"><i class="c-blue-500 ti-power-off"></i> </span>
            <span class="title">Đăng xuất</span>
        </a>
        <form id="logout-form" action="{{ url('admin/logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </li>
</ul>
