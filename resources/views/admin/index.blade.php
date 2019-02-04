@extends('layouts.app')

@section('content')
<div class="container marketing" style="margin-top:50px">
  <!-- Three columns of text below the carousel -->
  <div class="row mx-auto">
    <div class="col-lg-4">
      <a href="{{ route('admin.add-photos') }}">
        <img class="rounded-circle mx-auto d-block" style="background-color:skyblue;" src="img/add-photo.png" alt="add-photo" width="140" height="140">
      </a>
      <h2 class="text-center text-white mt-3">Add Photos</h2>
      <p class="text-center" style="color:skyblue;">
        Add new photos with details.
        Add new albums.
      </p>
    </div><!-- /.col-lg-4 -->
    <div class="col-lg-4">
      <img class="rounded-circle mx-auto d-block" style="background-color:skyblue;" src="img/photo-album.png" alt="Generic placeholder image" width="140" height="140">
      <h2 class="text-center text-white mt-3">View Photos</h2>
      <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit. Cras mattis consectetur purus sit amet fermentum. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh.</p>
      <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
    </div><!-- /.col-lg-4 -->
    <div class="col-lg-4">
      <a href="{{ route('admin.albums') }}">
        <img class="rounded-circle mx-auto d-block" style="background-color:skyblue;" src="img/add-photo.png" alt="add-photo" width="140" height="140">
      </a>
      <h2 class="text-center text-white mt-3">Blog</h2>
      <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
      <p><a class="btn btn-secondary" href="#" role="button">View details &raquo;</a></p>
    </div><!-- /.col-lg-4 -->
  </div><!-- /.row -->
</div>

@endsection
