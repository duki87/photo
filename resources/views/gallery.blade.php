@extends('layouts.front')

@section('head')
  @include('parts.head')
@endsection
@section('gallery')
  @include('parts.gallery')
@endsection
@section('footer')
<script src="js/img-gallery.js"></script>
<script src="js/fancy-box.js"></script>
  @include('parts.footer')
@endsection
