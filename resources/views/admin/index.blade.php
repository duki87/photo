@extends('layouts.app')

@section('content')
<div class="container marketing" style="margin-top:50px">
  <!-- Three columns of text below the carousel -->
  <div class="row mx-auto">

    <div class="col-md-4">
      <a href="{{ route('admin.albums') }}" class="button button-circle button-action text-white pt-4" style="margin-left:auto; margin-right:auto; display:block"><i class="fas fa-book-open fa-6x"></i></a>
      <hr style="background-color: green; height: 1px; border: 0;">
      <h3 class="text-white text-center mt-2">Dodaj novi album ili izmeni postojeci</h3>
    </div>
    <div class="col-md-4">
      <a href="{{ route('admin.add-photos') }}" class="button button-circle button-action text-white pt-4" style="margin-left:auto; margin-right:auto; display:block"><i class="far fa-images fa-6x"></i></a>
      <hr style="background-color: green; height: 1px; border: 0;">
      <h3 class="text-white text-center mt-2">Dodaj fotografije u albume</h3>
    </div>
    <div class="col-md-4">
      <a href="{{ route('admin.shootings') }}" class="button button-circle button-action text-white pt-4" style="margin-left:auto; margin-right:auto; display:block"><i class="fas fa-camera fa-6x"></i></a>
      <hr style="background-color: green; height: 1px; border: 0;">
      <h3 class="text-white text-center mt-2">Pogledaj zahteve za fotografisanjem</h3>
    </div>
    <div class="col-md-4">
      <a href="{{ route('admin.cleaner') }}" class="button button-circle button-caution text-white pt-4" style="margin-left:auto; margin-right:auto; display:block"><i class="fas fa-trash-alt fa-6x"></i></a>
      <hr style="background-color: red; height: 1px; border: 0;">
      <h3 class="text-white text-center mt-2">Ocisti foldere od nepovezanih fotografija</h3>
    </div>
    <div class="col-md-4">
      <a href="{{ route('front.index') }}" target="_blank" class="button button-circle button-primary text-white pt-4" style="margin-left:auto; margin-right:auto; display:block"><i class="far fa-eye fa-6x"></i></a>
      <hr style="background-color: skyblue; height: 1px; border: 0;">
      <h3 class="text-white text-center mt-2">Pogledaj verziju sajta za posetioce</h3>
    </div>

  </div><!-- /.row -->
</div>

@endsection
