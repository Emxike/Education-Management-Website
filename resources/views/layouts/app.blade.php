<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="{{ asset("asset/fronts/css/bootstrap.min.css") }}">
    <link rel="stylesheet" href="{{ asset("asset/fronts/css/style.css") }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css" integrity="sha256-46r060N2LrChLLb5zowXQ72/iKKNiw/lAmygmHExk/o=" crossorigin="anonymous" />
    <title>Idea | @yield("title")</title>
    @yield("style")
</head>
<body>

<header class="site-navbar js-sticky-header site-navbar-target" role="banner">
    <div style="padding: 0 40px">
        <div class="row align-items-center position-relative">
            <div class="site-logo">
                <a href="{{ route("home") }}" class="text-black"><span class="text-primary">IDEA</span></a>
            </div>

            <div class="col-12">
                <nav class="site-navigation text-right ml-auto " role="navigation">
                    <ul class="site-menu main-menu js-clone-nav ml-auto d-none d-lg-block">
                        @guest
                            @if (Route::has('login'))
                                <li><a href="{{ route('login') }}" class="nav-link">{{ __('Login') }}</a></li>
                            @endif

                            @if (Route::has('register'))
                                <li><a href="{{ route('register') }}" class="nav-link">{{ __('Register') }}</a></li>
                            @endif
                        @else
                            <li class="has-children" style="margin-right: 120px">
                                <a href="#about-section" class="nav-link">
                                    @php $userInfo = \Illuminate\Support\Facades\Auth::guard("web")->user() @endphp
                                    <img src="{{ !empty($userInfo->avatar) ? asset("/upload/{$userInfo->avatar}") : asset("asset/images/". ($userInfo->sex == 1 ? 'icon_female.png' : 'icon_male.png')) }}" class="rounded-circle"
                                         width="50" alt="User"/>
                                    {{ Auth::guard("web")->user()->staff_name }}
                                </a>
                                <ul class="dropdown arrow-top">
                                    <li><a href="{{ route("profile") }}" class="nav-link">Profile</a></li>
                                    <li><a href="{{ route("change-password") }}" class="nav-link">Change Password</a></li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</header>

@yield("content")
<script src="{{ asset("asset/fronts/js/jquery-3.3.1.min.js") }}"></script>
<script src="{{ asset("asset/fronts/js/bootstrap.min.js") }}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@yield("script")
</body>
</html>
