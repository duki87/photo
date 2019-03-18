@extends('layouts.front')

@section('head')
  @include('parts.head')
@endsection
@section('gallery')
  @include('parts.gallery2')
@endsection
@section('footer')
<script type="text/javascript" src="https://unpkg.com/nanogallery2/dist/jquery.nanogallery2.min.js"></script>
  @include('parts.footer')
@endsection
