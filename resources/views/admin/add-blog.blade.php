@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h2 style="color:white">Dodaj novi tekst na blog</h2>
      <div class="" id="message">
        @if(Session::has('blog_message'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <strong>{{Session::get('blog_message')}}</strong>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif
      </div>
      <hr style="background-color: yellow; height: 1px; border: 0;">
    </div>
    <div class="col-md-12">
      <form id="add-blog" class="row" action="{{route('admin.create-blog')}}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="form-group col-md-6">
            <label for="" style="color:white">Naslov teksta</label>
            <input type="text" name="title" id="title" class="form-control" placeholder="Unesi naslov teksta" value="" required>
          </div>
          <div class="form-group col-md-6">
            <label for="" style="color:white">Ime autora</label>
            <input type="text" name="author" id="author" class="form-control" placeholder="Unesi ime autora" value="{{ Auth::user()->name }}" required>
          </div>
           <div class="col-md-12 mt-2">
             <!-- Create the editor container -->
             <!-- <div id="editor" style="background-color:white; height:500px">

             </div> -->
             <textarea name="text" id="text" class="form-control"></textarea>
           </div>
           <div class="col-md-6 mt-2">
             <div class="custom-file">
               <input type="hidden" name="cover_photo" id="cover_photo" value="">
               <input type="file" class="custom-file-input" id="photos" name="photos[]" multiple>
               <label class="custom-file-label" for="customFile">Fotografije</label>
               <p id="message_images" class="text-danger d-none"></p>
             </div>
           </div>
           <div class="col-md-12 mt-2">
            <span style="color:yellow">Pregled fotografija <i>(Klikom na fotografiju oznacite naslovnu fotografiju)</i> </span>
            <div class="row" id="preview_photos" style="position:relative">

            </div>
          </div>
         <div class="form-group col-md-12">
           <button type="submit" disabled id="submit-btn" class="btn btn-success mt-5" name="submit">
             <span id="spinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
             <span id="btntext" class="">Dodaj tekst</span>
           </button>
         </div>
      </form>
    </div>
  </div>
</div>
<!-- Main Quill library -->
<!-- Include the Quill library -->
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<!-- Initialize Quill editor -->
<script>
  var quill = new Quill('#editor', {
    theme: 'snow'
  });
</script>
<script type="text/javascript">
  $(document).ready(function() {
    var storedFiles = [];
    //upload photos
    $(document).on('change', '#photos', function(e) {
      e.preventDefault();
      var files = $(this)[0].files;
			var imageType = /image.*/;
      for(let photo of files) {
        if(photo.type.match(imageType)) {
          storedFiles.push(photo);
          const reader = new FileReader();
          reader.onload = function(e) {
            let cover_photo = photo.name;
            let card =
            '<div class="col-md-2 ml-2 mt-2 blog-image" style="position:relative" data-photo="'+cover_photo+'">'+
              '<img src="'+reader.result+'" class="rounded" alt="..." style="width:100%; height:100%; object-fit:cover">'+
            '</div>';
            $('#preview_photos').append(card);
          }
          reader.readAsDataURL(photo);
        } else {
          $('#message_images').removeClass('d-none');
          $('#message_images').html("Fajlovi nedozvoljene ekstenzije su iskljuceni!");
        }
      }
      // if(storedFiles.length > 0) {
      //   $('#buttons').append('<button id="reset_input" title="Odbaci sve fotografije" class="btn btn-danger d-inline">Odbaci sve</button>');
      // }
      $(document).on('click', '.blog-image', function(e) {
        e.preventDefault();
        let cover = $(this).attr('data-photo');
        $('#cover_photo').val(cover);
        checkClass();
        $(this).addClass('cover-border');
        $('#submit-btn').prop('disabled', false);
      });
    });

    $(document).on('click', '#submit-btn', function(e) {
      console.log('dsfsf');
      $('#btntext').html('Ucitavanje...');
      $('#spinner').removeClass('d-none');
    });

    function checkClass() {
      var arr = $('.cover-border');
      if(arr.length > 0) {
        for(let f=0; f<arr.length; f++) {
          arr[f].classList.remove('cover-border');
          $('#submit-btn').prop('disabled', true);
        }
      }
    }
  });
</script>

@endsection
