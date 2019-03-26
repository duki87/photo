@extends('layouts.404')
<div class="container">
  <div class="row">
    <div class="col-md-6 mt-5">
      <img src="{{asset('img/404.png')}}" alt="">
    </div>
    <div class="col-md-6 mt-5">
      <h1 class="display-1">404</h1>
      <hr>
      <h1 class="display-4 text-muted">
        Ova stranica nije pronadjena.
      </h1>
      <blockquote class="blockquote">
        Stranica mozda ne postoji ili je doslo do greske.
        Vratite se na pocetnu stranu <a href="{{route('front.index')}}">ovde.</a>
      </blockquote>
    </div>
  </div>
</div>
