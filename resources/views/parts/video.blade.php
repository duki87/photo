<!-- Video Section Start -->
<section id="gallery" class="section">
  <div class="container">
    <div class="section-header">
      <h2 class="section-title wow fadeIn" data-wow-duration="1000ms" data-wow-delay="0.3s">Video klipovi</h2>
      <hr class="lines wow zoomIn" data-wow-delay="0.3s">
      <p class="section-subtitle wow fadeIn" data-wow-duration="1000ms" data-wow-delay="0.3s">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat, dignissimos! <br> Lorem ipsum dolor sit amet, consectetur.</p>
    </div>
    <div class="row">

      @foreach($videos as $video)
        <video src="{{asset('videos/'.$video->filename)}}" poster="posterimage.jpg" controls>

        </video>
      @endforeach

   </div>
  </div>
</section>
<!-- Services Section End -->
