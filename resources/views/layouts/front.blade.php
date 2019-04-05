<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords" content="Zilijen foto">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="author" content="Dusan Marinkovic">
    <link rel="shortcut icon" type="img/png" href="{{asset('img/logo-lens.png')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Zilijen Photographer</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/line-icons.css')}}">
    <link rel="stylesheet" href="{{asset('css/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{asset('css/owl.theme.css')}}">
    <link rel="stylesheet" href="{{asset('css/nivo-lightbox.css')}}">
    <link rel="stylesheet" href="{{asset('css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('css/slicknav.css')}}">
    <link rel="stylesheet" href="{{asset('css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('css/main.css')}}">
    <link rel="stylesheet" href="{{asset('css/responsive.css')}}">
    <link rel="stylesheet" href="{{asset('css/img-gallery.css')}}">
    <link rel="stylesheet" href="{{asset('css/albums.css')}}">
    <link rel="stylesheet" href="{{asset('css/blog.css')}}">
    <!--nanogallery2 - IF DON'T WANT THIS GALLERY DELETE LINK! -->
    <link href="https://unpkg.com/nanogallery2/dist/css/nanogallery2.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
  </head>
  <body>

    @yield('page_name')
    @yield('head')
    @yield('services')
    @yield('contact-form')
    @yield('portfolios')
    @yield('blog')
    @yield('single-blog')
    @yield('gallery')
    @yield('albums')
    @yield('video')
    @yield('front-blog')

    <!-- Go To Top Link -->
    <a href="#" class="back-to-top">
      <i class="lnr lnr-arrow-up lnr-custom"></i>
    </a>

    <div id="loader">
      <div class="spinner">
        <div class="double-bounce1"></div>
        <div class="double-bounce2"></div>
      </div>
    </div>

    <!-- jQuery first, then Tether, then Bootstrap JS. -->
    <script src="{{asset('js/jquery-min.js')}}"></script>
    <script src="{{asset('js/popper.min.js')}}"></script>
    <script src="{{asset('js/bootstrap4-3.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
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
    <!-- <script src="{{asset('js/waypoints.min.js')}}"></script> -->
    <!-- <script src="js/form-validator.min.js"></script>
    <script src="js/contact-form-script.js"></script> -->
    <script src="{{asset('js/main.js')}}"></script>
    <script src="{{asset('js/shoot-form.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
    <script src="{{asset('js/fancy-box.js')}}"></script>
    <script src="{{asset('js/img-gallery.js')}}"></script>
    @yield('footer')
  </body>
</html>
