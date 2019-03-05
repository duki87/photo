@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="" id="message">
        @if(Session::has('video_message'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <strong>{{Session::get('video_message')}}</strong>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif
      </div>
      <div class="" id="message">
        @if(Session::has('video_message_error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>{{Session::get('video_message_error')}}</strong>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif
      </div>
    </div>

    <div class="col-md-12">
      <h2 style="color:white">Svi video klipovi</h2>
      <hr style="background-color: yellow; height: 1px; border: 0;">
    </div>

    @foreach($videos as $video)
    <div class="col-md-4 mt-2 ">
      <video width="100%" height="300px" style="object-fit:cover" controls>
        <source src="{{asset('videos/'.$video->filename)}}" id="video_here">
          Vas pretrazivac ne podrzava HTML5 video.
      </video>
      <form class="" action="{{route('admin.edit-video')}}" method="post">
        @csrf
        <div class="form-group">
          <input type="hidden" name="id" value="{{$video->id}}">
          <input type="text" name="title" value="{{$video->title}}" class="form-control">
        </div>
        <div class="form-group">
          <textarea name="description" value="{{$video->title}}" class="form-control">{{$video->description}}</textarea>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-success" name="button"><i class="fas fa-edit"></i> Izmeni</button>
          <a href="{{route('admin.remove-video', $video->id)}}" onclick="return confirm('Da li ste sigurni da zelite da obrisete ovaj video klip?')" class="btn btn-danger" name="button"><i class="fas fa-trash-alt"></i> Obrisi video</a>
        </div>
      </form>
    </div>
    @endforeach

  </div><br>
  {{ $videos->links() }}
</div>

@endsection
