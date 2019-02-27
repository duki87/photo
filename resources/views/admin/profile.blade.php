@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <div class="" id="message">
        @if(Session::has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>{{Session::get('error')}}</strong>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif
        @if(Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>{{Session::get('success')}}</strong>
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
      <form class="" action="{{route('admin.update-profile')}}" method="post">
        @csrf
        <div class="form-group">
          <label for="" style="color:white">Ime</label>
          <input class="form-control" type="text" name="name" value="{{$admin->name}}" required>
        </div>
        <div class="form-group">
          <label for="" style="color:white">Email</label>
          <input type="hidden" name="old_email" value="{{$admin->email}}">
          <input class="form-control" type="email" name="email" value="{{$admin->email}}" required>
        </div>
        <div class="form-group">
          <label for="" style="color:white">Registrovan</label>
          <input class="form-control" type="text" disabled name="joined" value="{{$admin->created_at}}">
        </div>
      <div class="form-group">
        <button type="submit" class="btn btn-success" name="button"><i class="fas fa-edit"></i> Izmeni podatke</button>
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#password-change" name="button"><i class="fas fa-key"></i> Izmeni lozinku</button>
      </div>
    </div>
    </form>
  </div>
</div>
<!-- Modal -->
<div class="modal fade" id="password-change" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form class="" action="{{route('admin.change-password')}}" method="post">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Promena lozinke</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="email" value="{{$admin->email}}">
          <div class="form-group">
            <label for="" style="color:black">Stara lozinka</label>
            <input type="password" name="old_password" value="" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="" style="color:black">Nova lozinka</label>
            <input type="password" name="new_password" value="" class="form-control" required>
          </div>
          <div class="form-group">
            <label for="" style="color:black">Ponovi lozinku</label>
            <input type="password" name="check_password" value="" class="form-control" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Nazad</button>
          <button type="submit" class="btn btn-primary">Sacuvaj</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection
