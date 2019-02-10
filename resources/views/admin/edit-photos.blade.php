@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h2 style="color:white">Izmeni fotografije</h2>
      <div class="" id="message">
        @if(Session::has('photo_message'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <strong>{{Session::get('photo_message')}}</strong>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif
      </div>
      <hr style="background-color: yellow; height: 1px; border: 0;">
    </div>
    <div class="col-md-12">
      <div id="preview" class="row">
      @foreach($photos as $photo)
        <div class="col-md-2">
          <a href="" type="" class="details" data-toggle="modal" data-target="#details{{$photo->id}}"><img src="{{asset('img/albums/'.$album.'/'.$photo['filename'])}}" alt="..." class="img-thumbnail"></a>
        </div>
      @endforeach
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
@foreach($photos as $photo)
<div class="modal fade" id="details{{$photo->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form class="" action="index.html" method="post">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><img src="{{asset('img/albums/'.$album.'/'.$photo->filename)}}" width="70px" alt="..." class="img-thumbnail"> Izmeni fotografiju</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <input type="text" name="title" id="title" class="form-control title" value="{{$photo->title}}">
          </div>
          <div class="form-group">
            <textarea name="description" id="description" class="form-control description">{{$photo->description}}</textarea>
          </div>
          <div class="form-group">
            <input type="text" name="location" id="location" class="form-control location" value="{{$photo->location}}">
          </div>
          <div class="form-group">
            <select class="form-control album" id="album" name="album" value="{{$photo->album}}">
              @foreach($albums as $album)
                <option <?=($album->id == $photo->album ? 'selected' : '');?> value="{{$album->id}}">{{$album->title}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success" data-dismiss="modal">Izmeni</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Zatvori</button>
        </div>
      </form>
    </div>
  </div>
</div>
@endforeach

<script type="text/javascript">
  $(document).ready(function() {
    //upload photos
    $(document).on('change', '#photos', function(e) {
      e.preventDefault();
      var files = $(this)[0].files;
      const form_data = new FormData();
      for(let file of files) {
        form_data.append('images[]', file);
      }
      var album = $('#album').val();
      $('#album-name').val(album);
      if(album == '') {
        $('#message_images').removeClass('d-none');
        $('#message_images').html('Prvo odaberite album!');
        return false;
      }
      form_data.append('album', album);
      $.ajaxSetup({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
     });
      $.ajax({
         url: "upload-photos",
         type: "POST",
         data: form_data,
         dataType: 'json',
         contentType: false,
         cache: false,
         processData: false,
         success: function(result) {
           $('#preview').append(result.cards);
           $('#remove-all').removeClass('d-none');
           console.log(photosArr());
         }
       });
    });

    //remove specified photo
    $(document).on('click', '.remove-photo', function(e) {
      e.preventDefault();
      var photo = $(this).attr('data-photo');
      var album = $(this).attr('data-album');
      var id = $(this).parent().parent().parent().attr('id');
      console.log(id);
      const form_data = new FormData();
      if(album == '') {
        $('#message_images').removeClass('d-none');
        $('#message_images').html('Prvo odaberite album!');
        return false;
      }
      form_data.append('photo', photo);
      form_data.append('album', album);
      $.ajaxSetup({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
     });
      $.ajax({
         url: "remove-photo",
         type: "POST",
         data: form_data,
         dataType: 'json',
         contentType: false,
         cache: false,
         processData: false,
         success: function(result) {
           if(result.success == 'PHOTO_REMOVE') {
             $('#message_images').removeClass('d-none');
             $('#message_images').html('Fotografija obrisana');
             $('#'+id).remove();
           }
         }
       });
    });

    $(document).on('click', '#remove-all', function(e) {
      e.preventDefault();
      var album = $('#album-name').val();
      var filenames = [];
      const form_data = new FormData();
      for(let file of $('.filenames')){
        //filenames.push(file.value);
        form_data.append('filenames[]', file.value);
      }
      //console.log(filenames);
      form_data.append('album', album);
      $.ajaxSetup({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
     });
      $.ajax({
         url: "remove-uploads",
         type: "POST",
         data: form_data,
         dataType: 'json',
         contentType: false,
         cache: false,
         processData: false,
         success: function(result) {
           $('#preview').html('');
           $('#message_images').removeClass('d-none');
           $('#message_images').html('Fotografije su obrisane');
         }
       });
    });

    function photosArr() {
      var values = $("input[name='filename[]']")
         .map(function(){
           return $(this).val();
         }).get();
    }
  });
</script>
@endsection
