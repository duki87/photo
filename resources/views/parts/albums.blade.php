<!-- Services Section Start -->
<section id="gallery" class="section">
  <div class="container">
    <div class="section-header">
      <h2 class="section-title wow fadeIn" data-wow-duration="1000ms" data-wow-delay="0.3s">Izaberite album </h2>
      <hr class="lines wow zoomIn" data-wow-delay="0.3s">
      <p class="section-subtitle wow fadeIn" data-wow-duration="1000ms" data-wow-delay="0.3s">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat, dignissimos! <br> Lorem ipsum dolor sit amet, consectetur.</p>
    </div>
    <div class="row">

      @foreach($albums as $album)
        <div class="col-lg-3 col-md-4 col-xs-6 thumb">
          <a href="{{ route('front.gallery', $album->id) }}" class="" rel="">
            <img src="{{asset('img/album_covers/'.$album->cover)}}" alt="..." class="rounded mx-auto d-block" style="width: 100%; height: 100%; object-fit: cover;">
          </a>
        </div>
      @endforeach

   </div>
  </div>
</section>
<!-- Services Section End -->
