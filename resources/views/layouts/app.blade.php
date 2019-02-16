<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="zilijen foto">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="author" content="Dusan Marinkovic">
    <link rel="shortcut icon" type="img/png" href="img/logo-lens.png">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Zilijen foto | Admin Area</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/line-icons.css')}}">
    <link rel="stylesheet" href="{{asset('css/slicknav.css')}}">
    <link rel="stylesheet" href="{{asset('css/responsive.css')}}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/round-button.css')}}">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{asset('js/jquery-min.js')}}"></script>
</head>
<body style="background-color:black">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ route('admin.index') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    @if(isset($page_name))
                    <ul class="navbar-nav mr-auto">
                      <li class="nav-item">
                          <a class="nav-link {{'albums'==$page_name?'active':''}}" href="{{ route('admin.albums') }}">Albumi</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link {{'add-photos'==$page_name?'active':''}}" href="{{ route('admin.add-photos') }}">Dodaj fotografije</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link {{'shootings'==$page_name?'active':''}}" href="{{ route('admin.shootings') }}">Zahtevi {{App\Http\Controllers\ShootingController::number_of_requests()}}</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link {{'cleaner'==$page_name?'active':''}}" href="{{ route('admin.cleaner') }}">Ocisti foldere</a>
                      </li>
                    </ul>
                    @endif
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('front.index') }}" target="_blank">
                                        Verzija za posetioce
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
    </div>
    <div class="mt-4"></div>
    @yield('content')
    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="{{asset('js/jquery-min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/jquery.mixitup.js')}}"></script>
    <script src="{{asset('js/nivo-lightbox.js')}}"></script>
    <script src="{{asset('js/owl.carousel.js')}}"></script>
    <script src="{{asset('js/jquery.stellar.min.js')}}"></script>
    <script src="{{asset('js/jquery.nav.js')}}"></script>
    <script src="{{asset('js/scrolling-nav.js')}}"></script>
    <script src="{{asset('js/jquery.easing.min.js')}}"></script>
    <script src="{{asset('js/smoothscroll.js')}}"></script>
    <script src="{{asset('js/jquery.slicknav.js')}}"></script>
    <script src="{{asset('js/wow.js')}}"></script>
    <script src="{{asset('js/hero-slider.js')}}"></script>
    <script src="{{asset('js/jquery.vide.js')}}"></script>
    <script src="{{asset('js/jquery.counterup.min.js')}}"></script>
    <script src="{{asset('js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('js/waypoints.min.js')}}"></script>
    <script src="{{asset('js/form-validator.min.js')}}"></script>
    <script src="{{asset('js/contact-form-script.js')}}"></script>
</body>
</html>
