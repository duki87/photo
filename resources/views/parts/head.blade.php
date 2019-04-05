<!-- Header Section Start -->
<header id="hero-area" data-stellar-background-ratio="0.5">

  <div class="container">
    <div class="row justify-content-md-center">
      <div class="col-md-10">
        <div class="contents text-center">
          <h1 class="wow fadeInDown" data-wow-duration="1000ms" data-wow-delay="0.3s" style="color:rgba(0,0,0,0.9) !important">WE PHOTOGRAPH ANYTHING</h1>
          <p class="lead  wow fadeIn" data-wow-duration="1000ms" data-wow-delay="400ms">Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
          <!-- <a href="#" class="btn btn-common wow fadeInUp" data-wow-duration="1000ms" data-wow-delay="400ms">Download</a> -->
        </div>
      </div>
    </div>
  </div>
</header>
<!-- Header Section End -->
<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg fixed-top scrolling-navbar indigo" style="background-color:rgba(0,0,0,0.5)">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <a href="{{route('front.index')}}" class="navbar-brand" style="width:60%">
        <img src="{{asset('img/logo-2.png')}}" class="img-fluid" alt="">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-navbar" aria-controls="main-navbar" aria-expanded="false" aria-label="Toggle navigation">
        <i class="lnr lnr-menu"></i>
      </button>
    </div>
    <div class="collapse navbar-collapse justify-content-between" id="main-navbar">
      <ul class="navbar-nav ml-auto" id="page-links">
        <li class="nav-item">
          <a class="nav-link page-scroll {{ 'index' == $page_name ? 'active' : '' }}" style="" href="{{route('front.index')}}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link custom-nav-link page-scroll" href="#services">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link page-scroll {{ 'albums' == $page_name ? 'active' : '' }}" href="{{route('front.albums')}}">Galerije slika</a>
        </li>
        <li class="nav-item">
          <a class="nav-link page-scroll {{ 'videos' == $page_name ? 'active' : '' }}" href="{{route('front.videos')}}">Video</a>
        </li>
        <li class="nav-item">
          <a class="nav-link page-scroll {{ 'blog' == $page_name ? 'active' : '' }}" href="{{route('front.blogs')}}">Blog</a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto mt-2">
        <li class="nav-item">
          <a class="nav-link" id="navbar-show-hide">
            <i class="lnr lnr-menu" style="font-size:30px"></i>
          </a>
        </li>
      </ul>
    </div>
  </div>

  <!-- Mobile Menu Start -->
  <ul class="mobile-menu" style="">
     <li>
        <a class="page-scroll-m {{ 'index' == $page_name ? 'active-mobile' : '' }}" href="{{route('front.index')}}">Pocetna</a>
      </li>
      <li>
        <a class="page-scroll-m" href="#features">About</a>
      </li>
      <li>
        <a class="page-scroll-m {{ 'albums' == $page_name ? 'active-mobile' : '' }}" href="{{route('front.albums')}}">Galerija slika</a>
      </li>
      <li>
        <a class="page-scroll-m {{ 'videos' == $page_name ? 'active-mobile' : '' }}" href="{{route('front.videos')}}">Video</a>
      </li>
      <li >
        <a class="page-scroll-m {{ 'blog' == $page_name ? 'active-mobile' : '' }}" href="{{route('front.blogs')}}">Blog</a>
      </li>
      <li>
        <a class="page-scroll-m" href="#contact">Contact</a>
      </li>
  </ul>
  <!-- Mobile Menu End -->

</nav>
<!-- Navbar End -->
