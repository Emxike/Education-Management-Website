<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    @if(isset($menus))
        @foreach($menus as $key => $menu)
            <li class="nav-item {{ Request::is(config("app.route_admin").'/'.$menu->menu_href. '*') ? 'open active' : '' }}">
                @if(!$menu->menu_list || !$menu->menu_add)
                    <a class="nav-link" href="{{ route($menu->menu_href) }}">
                        <i class="{{$menu->menu_color}} {{$menu->menu_icon}}"></i>
                        <span>{{ $menu->menu_title }}</span>
                    </a>
                @endif
                @if($menu->menu_list || $menu->menu_add)
                        <a class="nav-link collapsed {{ Request::is(config("app.route_admin").'/'.$menu->menu_href) ? 'active' : '' }}"
                           href="#" data-toggle="collapse" data-target="#collapse-{{$key}}"
                           aria-expanded="true" aria-controls="collapse-{{$key}}">
                            <i class="{{$menu->menu_color}} {{$menu->menu_icon}}"></i>
                            <span>{{ $menu->menu_title }}</span>
                        </a>

                        <div id="collapse-{{$key}}" class="collapse" aria-labelledby="heading-{{$key}}" data-parent="#accordionSidebar">
                            <div class="bg-white py-2 collapse-inner rounded">
                                @if($menu->menu_list)
                                    <a class="collapse-item {{ Request::is(config("app.route_admin").'/'.$menu->menu_href) ? 'active' : '' }}"
                                       href="{{ route($menu->menu_href.".list") }}">List {{$menu->menu_title}}</a>

                                @endif
                                @if($menu->menu_add && $menu->add_flg)
                                    <a class="collapse-item {{ Request::is(config("app.route_admin").'/'.$menu->menu_href.'/add') || Request::is(config("app.route_admin").'/'.$menu->menu_href.'/edit/*') ? 'active' : '' }}"
                                       href="{{ route($menu->menu_href.".add") }}">Add {{$menu->menu_title}}</a>
                                @endif
                            </div>
                        </div>
                @endif
            </li>
            <hr class="sidebar-divider">
        @endforeach
    @endif
        <li class="nav-item">
            <a class="nav-link" href="{{route("admin.logout")}}" onclick="document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span></a>
            <form id="logout-form" action="{{ url('admin/logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </li>
</ul>
