<!-- Video Section Start -->
<section id="gallery" class="section">
  <div class="container">
    <div class="section-header">
      <h2 class="section-title wow fadeIn" data-wow-duration="1000ms" data-wow-delay="0.3s">Video klipovi</h2>
      <hr class="lines wow zoomIn" data-wow-delay="0.3s">
      <p class="section-subtitle wow fadeIn" data-wow-duration="1000ms" data-wow-delay="0.3s">Pogledajte nase video klipove.</p>
    </div>
    <div class="row">

      @foreach($videos as $video)
      <div class="col-md-6 mx-auto">
        <h4 class="section-title text-center" style="color: #ffff66" data-wow-duration="1000ms" data-wow-delay="0.3s">{{$video->title}}</h4>
        <video src="{{asset('videos/'.$video->filename)}}" width="100%" poster="posterimage.jpg" controls>
        </video>
        <p class="section-subtitle" style="color: #ffff66">Opis klipa:</p>
        <p class="section-subtitle" style="color: white" data-wow-duration="1000ms" data-wow-delay="0.3s">{{$video->description}}</p>
      </div>
      @endforeach

   </div>
  </div>
</section>
<!-- Services Section End -->
