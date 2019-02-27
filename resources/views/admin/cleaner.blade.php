@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h2 style="color:white">Ocisti foldere</h2>
      <div class="" id="message">
        @if(Session::has('cleaner_message'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <strong>{{Session::get('cleaner_message')}}</strong>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif
      </div>
      <hr style="background-color: yellow; height: 1px; border: 0;">
      <p style="color:white">Ocisti albume od fotografija koje su greskom unete ili nisu povezane sa bazom kako ne bi zauzimale mesto na serveru.</p>
    </div>
    <div class="col-md-12">
      <form id="clean" action="{{route('admin.clean-folder')}}" method="POST">
        @csrf
        <div class="form-group col-md-6">
          <select name="album" id="album" class="form-control" required>
            <option value="">Izaberite album</option>
            @foreach($albums as $album)
              <option value="{{$album->id}}">{{$album->title}}</option>
            @endforeach
          </select>
        </div>

       <div class="form-group">
         <button type="submit" class="btn btn-success mt-5" name="submit">Ocisti</button>
       </div>
     </form>
    </div>
  </div>
</div>

@endsection
