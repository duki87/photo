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
      </div>
      <hr style="background-color: yellow; height: 1px; border: 0;">
    </div>
    <div class="col-md-12">
      <form id="add-photos" action="" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group col-md-6">
          <select name="album" id="album" class="form-control" required>
            <option value="">Izaberite album</option>
            @foreach($albums as $album)
              <option value="{{$album->id}}">{{$album->title}}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group col-md-6">
          <div class="custom-file">
            <input type="file" class="custom-file-input" id="photos" name="photos[]" multiple>
            <label class="custom-file-label" for="customFile">Izaberite fotografije</label>
            <p id="message_images" class="text-danger d-none"></p>
          </div>
        </div>
        <div id="preview" class="row">

        </div>

       <div class="form-group">
         <button type="submit" class="btn btn-success mt-5" name="submit">Dodaj fotografije</button>
       </div>
     </form>
    </div>
  </div>
</div>

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
  });
</script>
@endsection
