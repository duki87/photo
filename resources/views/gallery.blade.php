@extends('layouts.front')

@section('head')
  @include('parts.head')
@endsection
@section('gallery')
  @include('parts.gallery')
@endsection
@section('footer')
<script src="{{asset('js/img-gallery.js')}}"></script>
<script src="{{asset('js/fancy-box.js')}}"></script>
<script src="{{asset('js/hero-slider.js')}}"></script>
  @include('parts.footer')
@endsection
