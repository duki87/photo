@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h2 style="color:white">Shooting Requests</h2>
      <div class="" id="message">
        @if(Session::has('shooting_message'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <strong>{{Session::get('shooting_message')}}</strong>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif
      </div>
      <hr style="background-color: yellow; height: 1px; border: 0;">
    </div>
    <div class="col-md-12">
      <table class="table table-hover table-striped" style="color:white">
        <thead>
          <tr>
            <th scope="col">Date</th>
            <th scope="col">City</th>
            <th scope="col">Name</th>
            <th scope="col">Place</th>
          </tr>
        </thead>
        <tbody>
          @foreach($shootings as $shooting)
          <tr>
            <th scope="row">{{$shooting->date}}</th>
            <td>{{$shooting->city}}</td>
            <td>{{$shooting->name}}</td>
            <td>{{$shooting->place}}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
{{ $shootings->links() }}
    </div>


  </div>
</div>
@endsection
