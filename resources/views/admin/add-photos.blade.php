@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h2 style="color:white">Dodaj fotografije</h2>
      <div class="" id="message">
        @if(Session::has('photo_message'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <strong>{{Session::get('photo_message')}}</strong>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif
        @if(Session::has('photo_message_err'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Doslo je do greske.</strong> {{Session::get('photo_message_err')}}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif
      </div>
      <hr style="background-color: yellow; height: 1px; border: 0;">
    </div>
    <div class="col-md-6">
      <form id="add-photos" action="{{route('admin.upload-photos')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group col-md-12">
          <select name="album" id="album" class="form-control" required>
            <option value="">Izaberite album</option>
            @foreach($albums as $album)
              <option value="{{$album->id}}">{{$album->title}}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group col-md-12">
          <div class="custom-file" id="file-input">
            <input type="file" class="custom-file-input" id="photos" name="photos[]" multiple>
            <label class="custom-file-label" for="customFile">Izaberite fotografije</label>
            <button type="button" name="button" class="btn btn-danger btn-sm mt-2 d-none" id="remove-all">Izbrisi sve ucitane fotografije</button>
            <p id="message_images" class="text-danger d-none"></p>
          </div>
        </div>
       <div class="col-md-12" id="buttons">
         <button type="submit" disabled id="submit-btn" class="btn btn-success mt-5" name="submit">
           <span id="spinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
           <span id="btntext" class="">Dodaj fotografije</span>
         </button>
       </div>
     </form>
    </div>
    <div class="col-md-6">
      <div class="row" id="preview_files">

      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $('#submit-btn').prop('disabled', true);
    var storedFiles = [];

    $(document).on('change', '#photos', function(e) {
      e.preventDefault();
      let album_id = $('#album').val();
      if(album_id == '') {
        $('#message_images').removeClass('d-none');
        $('#message_images').html('Prvo odaberite album!');
        return false;
      } else {
        var files = $(this)[0].files;
  			var imageType = /image.*/;
        for(let photo of files) {
          if(photo.type.match(imageType)) {
            storedFiles.push(photo);
            const reader = new FileReader();
            reader.onload = function(e) {
              let card =
              '<div class="col-md-4 mt-2" style="position:relative">'+
                '<img src="'+reader.result+'" class="rounded" alt="..." style="width:100%; height:100%; object-fit:cover">'+
              '</div>';
                // '<div class="col-md-2 ml-2 mt-2" style="position:relative">'+
                //   '<button title="Klikni da obrises fotografiju" class="very-small-btn remove_from_input" data-file="'+photo.name+'" style="position:absolute;top:0px;right:14px;">x</button>'+
                //   '<img src="'+reader.result+'" class="rounded" alt="..." style="width:100%; height:100%; object-fit:cover">'+
                // '</div>';
              $('#preview_files').append(card);
            }
            reader.readAsDataURL(photo);
            $('#submit-btn').prop('disabled', false);
          } else {
            $('#message_images').removeClass('d-none');
            $('#message_images').html("Fajlovi nedozvoljene ekstenzije su iskljuceni!");
          }
        }
        if(storedFiles.length > 0) {
          if($('.reset_input').length < 1) {
            $('#file-input').append('<button id="reset_input" title="Odbaci sve fotografije" class="btn btn-danger btn-sm mt-2 d-inline reset_input">Odbaci sve</button>');
          }
        }
      }
    });

    $(document).on('click', '#reset_input', function(e) {
      e.preventDefault();
      $('#preview_files').html('');
      $('#photos').val('');
      storedFiles = [];
      $(this).remove();
      $('#submit-btn').prop('disabled', true);
    });

    $(document).on('click', '#submit-btn', function(e) {
      console.log('dsfsf');
      $('#btntext').html('Ucitavanje...');
      $('#spinner').removeClass('d-none');
    });

    //Functions that where used before
    //
    // $(document).on('click', '.remove_from_input', function(e) {
    //   var file = $(this).attr('data-file');
    //   for(var i=0;i<storedFiles.length;i++) {
    //     if(storedFiles[i].name === file) {
    //       storedFiles.splice(i,1);
    //       break;
    //     }
    //   }
    //   if(storedFiles.length < 1) {
    //     $('#submit-btn').prop('disabled', true);
    //   }
    //   $(this).parent().remove();
    //   console.log(storedFiles);
    // });

    //upload photos
    // $(document).on('change', '#photos', function(e) {
    //   e.preventDefault();
    //   var files = $(this)[0].files;
    //   const form_data = new FormData();
    //   for(let file of files) {
    //     form_data.append('images[]', file);
    //   }
    //   var album = $('#album').val();
    //   $('#album-name').val(album);
    //   if(album == '') {
    //     $('#message_images').removeClass('d-none');
    //     $('#message_images').html('Prvo odaberite album!');
    //     return false;
    //   }
    //   form_data.append('album', album);
    //   $.ajaxSetup({
    //      headers: {
    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //      }
    //  });
    //   $.ajax({
    //      url: "upload-photos",
    //      type: "POST",
    //      data: form_data,
    //      dataType: 'json',
    //      contentType: false,
    //      cache: false,
    //      processData: false,
    //      success: function(result) {
    //        $('#preview').append(result.cards);
    //        $('#remove-all').removeClass('d-none');
    //        $('#submit-btn').removeClass('d-none');
    //        console.log(photosArr());
    //      }
    //    });
    // });

    // function photosArr() {
    //   var values = $("input[name='filename[]']")
    //      .map(function(){
    //        return $(this).val();
    //      }).get();
    // }
  });
</script>
@endsection
