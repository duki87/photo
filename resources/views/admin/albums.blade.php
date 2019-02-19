@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="" id="message">
        @if(Session::has('album_message'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <strong>{{Session::get('album_message')}}</strong>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif
      </div>
    </div>

    <div class="col-md-12">
      <h2 style="color:white">Svi albumi</h2>
      <hr style="background-color: yellow; height: 1px; border: 0;">
    </div>
    @foreach($albums as $album)
    <div class="col-md-4 mt-2 d-flex align-items-stretch">
      <div class="card" style="background-color:rgba(255,255,255,0.2)">
        <img src="{{asset('img/album_covers/'.$album->cover)}}" class="card-img-top" height="100%" width="auto"  alt="..." style="object-fit:cover">
        <div class="card-body">
          <h3 class="card-title d-inline" style="color:yellow">{{$album->title}}</h3><h5 class="text-secondary d-inline"> Broj fotografija {{count($album->photos)}}</h5> <br>
          <div class="mt-2">
            <a href="{{route('admin.edit-album', $album->id)}}" class="btn btn-primary d-inline" title="Izmeni informacije o albumu"><i class="fas fa-edit"></i></a>
            <a href="{{route('admin.edit-photos', $album->id)}}" class="btn btn-warning d-inline" title="Izmeni fotografije u albumu"><i class="far fa-images"></i></a>
            <a href="{{route('admin.remove-album', $album->id)}}" class="btn btn-danger d-inline" title="Obrisi album" onclick="return confirm('Da li ste sigurni da zelite da obrisete ovaj album?')"><i class="fas fa-trash-alt"></i></a>
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>

@endsection
