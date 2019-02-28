@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h2 style="color:white">Zahtevi za fotografisanjem</h2>
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
            <th scope="col" class="text-center">Datum</th>
            <th scope="col" class="text-center">Mesto</th>
            <th scope="col" class="text-center">Adresa</th>
            <th scope="col" class="text-center">Oznaci kao procitano</th>
            <th scope="col" class="text-center">Detalji</th>
          </tr>
        </thead>
        <tbody>
          @foreach($shootings as $shooting)
          <tr>
            <th class="text-center">{{$shooting->date}}</th>
            <td class="text-center">{{$shooting->city}}</td>
            <td class="text-center">{{$shooting->place}}</td>
            <td class="text-center">
              @if($shooting->status == 1)
              <a href="{{route('admin.change-shooting-status', $shooting->id)}}" type="button" class="btn btn-danger unread" name="{{$shooting->id}}" title="Promeni status u procitano" id="{{$shooting->id}}"><i class="fas fa-times"></i></a>
              @else
              <a href="{{route('admin.change-shooting-status', $shooting->id)}}" type="button" class="btn btn-secondary unread" name="{{$shooting->id}}" title="Promeni status u neprocitano" id="{{$shooting->id}}"><i class="fas fa-check"></i></a>
              @endif
            </td>
            <td class="text-center"><button type="button" class="btn btn-success details" data-toggle="modal" data-target="#details{{$shooting->id}}" name=""><i class="fas fa-eye"></i></button></td>
          </tr>
          @endforeach
        </tbody>
      </table>
      {{ $shootings->links() }}
    </div>
  </div>
</div>
<!-- Modal -->
@foreach($shootings as $shooting)
<div class="modal fade" id="details{{$shooting->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Detalji zahteva</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
          Ime i prezime: {{$shooting->date}}<br>
          Mesto: {{$shooting->city}}<br>
          Adresa: {{$shooting->place}}<br>
          Datum: {{$shooting->date}}<br>
          Dogadjaj: {{$shooting->event}}<br>
          Telefon: {{$shooting->phone}}<br>
          E-mail: {{$shooting->email}}<br>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endforeach

@endsection
