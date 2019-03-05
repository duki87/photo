<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="zilijen foto">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="author" content="Dusan Marinkovic">
    <link rel="shortcut icon" type="img/png" href="{{asset('img/logo-lens.png')}}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Zilijen foto | Admin Area</title>

    <!-- Bootstrap CSS -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous"> -->
    <link rel="stylesheet" href="{{asset('css/bootstrap4-3.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/line-icons.css')}}">
    <link rel="stylesheet" href="{{asset('css/slicknav.css')}}">
    <link rel="stylesheet" href="{{asset('css/responsive.css')}}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="{{asset('css/round-button.css')}}">
    <link rel="stylesheet" href="{{asset('css/app-custom.css')}}">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="{{asset('js/jquery-min.js')}}"></script>
</head>
<body style="background-color:black">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel" style="background-color:#ffcc00">
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
                      <li class="nav-item dropdown {{'albums'==$page_name?'active':''}} {{'add_album'==$page_name?'active':''}}">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fas fa-book-open"></i> Albumi
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <a class="dropdown-item" href="{{ route('admin.albums') }}"><i class="fas fa-book-open" style="color:#ffcc00"></i> Svi albumi</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="{{ route('admin.add-album') }}"><i class="fas fa-plus" style="color:#ffcc00"></i> Dodaj album</a>
                        </div>
                      </li>

                      <li class="nav-item dropdown {{'add_videos'==$page_name?'active':''}} {{'videos'==$page_name?'active':''}}">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <i class="fas fa-video"></i> Video
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <a class="dropdown-item" href="{{ route('admin.videos') }}"><i class="fas fa-video" style="color:#ffcc00"></i> Svi video klipovi</a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="{{ route('admin.add-videos') }}"><i class="fas fa-plus" style="color:#ffcc00"></i> Dodaj video</a>
                        </div>
                      </li>

                      <li class="nav-item">
                          <a class="nav-link {{'add-photos'==$page_name?'active':''}} {{'add-info'==$page_name?'active':''}}" href="{{ route('admin.add-photos') }}"><i class="far fa-images"></i> Dodaj fotografije</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link {{'shootings'==$page_name?'active':''}}" href="{{ route('admin.shootings') }}"><i class="fas fa-camera"></i> Zahtevi {{App\Http\Controllers\ShootingController::number_of_requests()}}</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link {{'cleaner'==$page_name?'active':''}}" href="{{ route('admin.cleaner') }}"><i class="fas fa-trash-alt"></i> Ocisti foldere</a>
                      </li>
                    </ul>
                    @endif
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Prijavi se') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Registracija') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown {{'profile'==$page_name?'active':''}} {{'info'==$page_name?'active':''}}">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('front.index') }}" target="_blank">
                                        <i class="far fa-eye" style="color:#ffcc00"></i> Verzija za posetioce
                                    </a>
                                    <a class="dropdown-item" href="{{ route('admin.profile') }}">
                                        <i class="fas fa-user" style="color:#ffcc00"></i> Profil
                                    </a>
                                    <a class="dropdown-item" href="{{ route('admin.info') }}">
                                        <i class="fas fa-info-circle" style="color:#ffcc00"></i> Info
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt" style="color:#ffcc00"></i> {{ __('Odjavi se') }}
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
    <!-- Scripts -->
    <script src="{{asset('js/jquery-min.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/bootstrap4-3.min.js')}}"></script>
    <!-- <script src="{{ asset('js/app.js') }}" defer></script> -->
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
    <script src="{{asset('js/jquery.vide.js')}}"></script>
    <script src="{{asset('js/jquery.counterup.min.js')}}"></script>
    <script src="{{asset('js/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('js/form-validator.min.js')}}"></script>
</body>
</html>
