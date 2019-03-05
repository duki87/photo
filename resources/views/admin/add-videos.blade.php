@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h2 style="color:white">Dodaj video</h2>
      <div class="" id="message">
        @if(Session::has('video_message'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <strong>{{Session::get('video_message')}}</strong>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif
        @if(Session::has('video_message_err'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Doslo je do greske.</strong> {{Session::get('video_message_err')}}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif
      </div>
      <hr style="background-color: yellow; height: 1px; border: 0;">
    </div>
    <div class="col-md-6">
      <form id="add-video" action="{{route('admin.upload-video')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <div class="custom-file">
            <input type="file" class="custom-file-input" name="video" id="video">
            <label class="custom-file-label" for="customFile">Izaberite video</label>
            <button type="button" name="button" class="btn btn-danger btn-sm mt-2 d-none" id="remove-all">Izbrisi sve ucitane fotografije</button>
            <p id="message_video" class="text-danger d-none"></p>
          </div>
        </div>
        <div class="form-group">
          <label for="" style="color:white">Naziv</label>
          <input type="text" name="title" value="" class="form-control">
        </div>
        <div class="form-group">
          <label for="" style="color:white">Opis</label>
          <textarea name="description" class="form-control"></textarea>
        </div>

        <div class="form-group" id="buttons">
          <button type="submit" disabled id="submit-btn" class="btn btn-success mt-5" name="submit">
            <span id="spinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
            <span id="btntext" class="">Dodaj video</span>
          </button>
        </div>
     </form>
    </div>
    <div class="col-md-6">
      <div class="" id="preview_files">
        <video width="100%" controls>
          <source src="" id="video_here">
            Vas pretrazivac ne podrzava HTML5 video.
        </video>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $('#submit-btn').prop('disabled', true);
    var storedFiles = [];

    $(document).on('click', '#reset_input', function(e) {
      e.preventDefault();
      $('#preview_files').html('');
      $('#photos').val('');
      storedFiles = [];
      $(this).remove();
      $('#submit-btn').prop('disabled', true);
    });

    $(document).on('click', '#submit-btn', function(e) {
      $('#btntext').html('Ucitavanje...');
      $('#spinner').removeClass('d-none');
    });

    $(document).on('change', '#video', function(e) {
      var property = document.getElementById('video').files[0];
      var video_name = property.name;
      let video_extension = video_name.split('.').pop().toLowerCase();
      if(video_extension !== 'mp4') {
        $('#message_video').removeClass('d-none');
        $('#message_video').html('Dozvoljeni format je mp4!');
        $('#video').val('');
        return false;
      }
      let video_ize = property.size;
      if(video_ize > 104857600) {
        $('#message_video').removeClass('d-none');
        $('#message_video').html('Maksimalna dozvoljena velicina je 100 MB!');
        $('#video').val('');
        return false;
      }
      var $source = $('#video_here');
      $source[0].src = URL.createObjectURL(this.files[0]);
      $source.parent()[0].load();
      $('#submit-btn').prop('disabled', false);
    });
  });
</script>
@endsection
