@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="" id="message">
        @if(Session::has('profile_message'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <strong>{{Session::get('profile_message')}}</strong>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif
      </div>
    </div>
    <div class="col-md-12">
      <h2 style="color:white">Profil administratora <strong style="color:yellow">{{$admin->name}}</strong></h2>
      <hr style="background-color: yellow; height: 1px; border: 0;">
    </div>
    <div class="col-md-6 mx-auto">
      <form class="" action="" method="post">
        @csrf
        <div class="form-group">
          <label for="" style="color:white">Ime</label>
          <input class="form-control" type="text" name="name" value="{{$admin->name}}">
        </div>
        <div class="form-group">
          <label for="" style="color:white">Email</label>
          <input class="form-control" type="email" name="email" value="{{$admin->email}}">
        </div>
        <div class="form-group">
          <label for="" style="color:white">Lozinka</label>
          <input class="form-control" type="password" name="password" value="">
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
