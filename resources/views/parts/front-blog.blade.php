<!-- Blog Section -->
<section id="blog" class="section">
  <!-- Container Starts -->
  <div class="container">
    <div class="section-header">
      <h2 class="section-title">Najnoviji tekstovi na blogu</h2>
      <hr class="lines">
      <p class="section-subtitle">Procitajte nase tekstove o najnovijim desavanjima iz oblasti fotografije.</p>
    </div>
    <div class="row">
      @if(isset($blogs))
        @foreach($blogs as $blog)
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 blog-item mt-2">
          <!-- Blog Item Starts -->
          <div class="blog-item-wrapper p-3 blog-wrapper">
            <div class="blog-item-img">
              <a href="{{route('front.blog', $blog->url)}}">
                <img src="{{asset('img/blog/'.$blog->cover_image)}}" alt="" style="height:200px; object-fit:cover">
              </a>
            </div>
            <div class="blog-item-text">
              <div class="meta-tags">
                <span class="date"><i class="lnr  lnr-clock"></i>{{date("d-m-Y", strtotime($blog->created_at))}}</span>
                <!-- <span class="comments"><a href="#"><i class="lnr lnr-bubble"></i> 24 Comments</a></span> -->
                <span class="comments float-right"><i class="lnr lnr-pencil"></i>{{$blog->author}}</span>
              </div>
              <h3>
                <a href="{{route('front.blog', $blog->url)}}">{{$blog->title}}</a>
              </h3>
              <p>
              {{substr($blog->text,0,100) }}
              </p>
              <a href="{{route('front.blog', $blog->url)}}" class="btn-rm">Procitaj vise <i class="lnr lnr-arrow-right"></i></a>
            </div>
          </div>
          <!-- Blog Item Wrapper Ends-->
        </div>
        @endforeach
      @endif
    </div>
  </div>
</section> -->
<!-- blog Section End -->
