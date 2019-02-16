<!-- Services Section Start -->
<section id="gallery" class="section">
  <div class="container">
    <div class="section-header">
      <h2 class="section-title wow fadeIn" data-wow-duration="1000ms" data-wow-delay="0.3s">Gallery | <span style="color:#66ff33">{{$album->title}}</span> </h2>
      <hr class="lines wow zoomIn" data-wow-delay="0.3s">
      <p class="section-subtitle wow fadeIn" data-wow-duration="1000ms" data-wow-delay="0.3s">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat, dignissimos! <br> Lorem ipsum dolor sit amet, consectetur.</p>
    </div>
    <div class="row">
      @foreach($album->photos as $photo)
      <div class="col-lg-3 col-md-4 col-xs-6 thumb">
        <a href="{{asset('img/albums/'.$album->title.'/'.$photo->filename)}}" data-fancybox-title="{{$photo->title}}" class="fancybox" rel="ligthbox">
          <img src="{{asset('img/albums/'.$album->title.'/'.$photo->filename)}}" class="zoom img-fluid "  alt="">
        </a>
      </div>
      @endforeach
   </div>
  </div>
</section>
<!-- Services Section End -->
