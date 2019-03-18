<!-- Services Section Start -->
<section id="gallery" class="section">
  <div class="container">
    <div class="section-header">
      <h2 class="section-title wow fadeIn" data-wow-duration="1000ms" data-wow-delay="0.3s">Album | <span style="color:#66ff33">{{$album->title}}</span> </h2>
      <hr class="lines wow zoomIn" data-wow-delay="0.3s">
      <p class="section-subtitle wow fadeIn" data-wow-duration="1000ms" data-wow-delay="0.3s">{{$album->description}}</p>
    </div>
    <div class="">
      <div id="ngy2p" data-nanogallery2='{
          "itemsBaseURL": "",
          "thumbnailWidth": "auto",
          "thumbnailAlignment": "center"
        }'>
        @foreach($album->photos as $photo)

          <a href="{{asset('img/albums/'.$album->title.'/'.$photo->filename)}}" data-ngthumb="{{asset('img/albums/'.$album->title.'/'.$photo->filename)}}" data-ngdesc="{{$photo->description}}">{{$photo->title}}</a>

        @endforeach

      </div>
   </div>
  </div>
</section>
<!-- Services Section End -->
