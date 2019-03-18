<!-- Services Section Start -->
<section id="services" class="section">
  <div class="container">
    <div class="section-header">
      <h2 class="section-title wow fadeIn" data-wow-duration="1000ms" data-wow-delay="0.3s">{{$blog->title}}</h2>
      <hr class="lines wow zoomIn" data-wow-delay="0.3s">
      <p class="section-subtitle wow fadeIn" data-wow-duration="1000ms" data-wow-delay="0.3s">Autor {{$blog->author}}</p>
    </div>
    <div class="row">
      <p class="blog-text">
        <img src="{{asset('img/blog/'.$blog->cover_image)}}" class="blog-image" alt="">
        {{$blog->text}}
      </p>
      @if(isset($blog->images))
        @foreach($blog->images as $image)
        <div class="col-lg-3 col-md-4 col-xs-6 thumb">
          <a href="{{asset('img/blog/'.$image->image)}}" class="fancybox" rel="ligthbox">
            <img src="{{asset('img/blog/'.$image->image)}}" class="zoom img-fluid "  alt="">
          </a>
        </div>
        @endforeach
      @endif
    </div>
  </div>
</section>
<!-- Services Section End -->
