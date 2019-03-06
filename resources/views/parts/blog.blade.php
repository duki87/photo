<!-- Blog Section -->
<section id="blog" class="section">
  <!-- Container Starts -->
  <div class="container">
    <div class="section-header">
      <h2 class="section-title">Recent Blog</h2>
      <hr class="lines">
      <p class="section-subtitle">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quaerat, dignissimos! <br> Lorem ipsum dolor sit amet, consectetur.</p>
    </div>
    <div class="row">
      @foreach($blogs as $blog)
      <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 blog-item mt-2">
        <!-- Blog Item Starts -->
        <div class="blog-item-wrapper p-3">
          <div class="blog-item-img">
            <a href="single-post.html">
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
              <a href="single-post.html">{{$blog->title}}</a>
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
    </div>
  </div>
</section> -->
<!-- blog Section End -->
