<!doctype html>
<html lang="en">
<head>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link rel="stylesheet" href="{{ asset("asset/fronts/css/style.css") }}">
    <link rel="stylesheet" href="{{ asset("asset/fronts/css/auth.css") }}">


</head>
<body>

<header class="site-navbar js-sticky-header site-navbar-target pd-3" role="banner">
    <div class="row align-items-center position-relative">
        <div class="site-logo">
            <a class="text-black"><span class="text-primary">IDEA</span></a>
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
                    @endguest
                </ul>
            </nav>
        </div>

    </div>
</header>
@yield('content')

</body>
</html>
