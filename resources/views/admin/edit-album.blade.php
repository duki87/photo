@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h2 style="color:white">Edit Album <span style="color:yellow">{{$album->title}}</span></h2>
      <div class="" id="message">
        @if(Session::has('album_edit_message'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
          <strong>{{Session::get('album_edit_message')}}</strong>
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        @endif
      </div>
      <hr style="background-color: yellow; height: 1px; border: 0;">
    </div>
    <div class="col-md-6">
      <form id="add-album" action="{{route('admin.update-album')}}" method="POST">
        @csrf
        <div class="form-group">
          <input type="text" name="title" id="title" class="form-control" placeholder="Add Album Title" value="{{$album->title}}" required>
        </div>
        <div class="form-group">
          <textarea name="description" id="description" class="form-control" placeholder="Add Album Description" value="">{{$album->description}}</textarea>
        </div>
       <div class="custom-file">
         <input type="file" class="custom-file-input" id="album_cover" name="album_cover">
         <input type="hidden" id="cover" name="cover" name="" value="{{$album->cover}}">
         <label class="custom-file-label" for="customFile">Choose Album Cover</label>
         <p id="message_images" class="text-danger d-none"></p>
       </div>
       <div class="form-group">
         <input type="hidden" name="id" value="{{$album->id}}">
         <button type="submit" class="btn btn-success mt-5" name="submit">Edit Album</button>
       </div>
     </form>
    </div>
    <div class="col-md-6">
      <span style="color:yellow">Preview Cover</span>
      <div class="" id="preview_cover" style="position:relative">
        <img src="{{asset('img/album_covers/'.$album->cover)}}" class="" id="image" alt="" style="position:relative;border:1px solid yellow; width:100%; height:auto">

        <button class="btn btn-danger btn-xs remove_image {{ $album->cover == 'default.jpg' ? 'd-none' : ''}}" id="remove_image" data-path="{{$album->cover}}" style="position:absolute; right:30px; top:20px">x</button>

      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $(document).on('change', '#album_cover', function(event) {
      event.preventDefault();
      var property = document.getElementById('album_cover').files[0];
      var image_name = property.name;
      var image_extension = image_name.split('.').pop().toLowerCase();
      if(jQuery.inArray(image_extension, ["jpg","jpeg","png","gif"]) == -1) {
        error_images = 'Allowed formats: gif, jpg, jpeg, png!';
        $('#message_images').removeClass('d-none');
        $('#message_images').html('<span class="text-danger">'+error_images+'</span>');
        return false;
      }
      var image_size = property.size;
      if(image_size > 5000000) {
        error_images = 'Maximum file size: 5 MB!';
        $('#message_images').removeClass('d-none');
        $('#message_images').html('<span class="text-danger">'+error_images+'</span>');
        return false;
      } else {
        if($('#cover').val() !== '') {
          var path = $('#cover').val();
          if(path !== 'default.jpg') {
            remove_cover_photo(path);
            $('#preview_cover').html('');
            $('#cover').val('');
          } else {
            $('#preview_cover').html('');
            $('#cover').val('');
          }
        }
        var form_data = new FormData();
        form_data.append('album_cover', property);
        $.ajaxSetup({
           headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
       });
        $.ajax({
           url: "{{url('admin-area/add-cover-photo')}}",
           type: "POST",
           data: form_data,
           dataType: 'json',
           contentType: false,
           cache: false,
           processData: false,
           success: function(result) {
             var remove = '<button class="btn btn-danger btn-xs remove_image" id="remove_image" data-path="'+ result.filename+'" style="position:absolute; right:30px; top:20px">x</button>';
             $('#preview_cover').append('<img src="'+ result.image_path +'" class="" id="image" alt="" style="position:relative;border:1px solid yellow; width:100%; height:auto">');
             $('#preview_cover').append(remove);
             $('#message_images').removeClass('d-none');
             $('#message_images').html('<span class="text-success">Image uploaded.</span>');
             $('#cover').val(result.filename);
           }
         });
      }
    });

    function remove_cover_photo(filename) {
      var form_data = new FormData();
      form_data.append('path', filename);
      $.ajaxSetup({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
     });
      $.ajax({
         url: "{{url('admin-area/remove-cover-photo')}}",
         type: "POST",
         data: form_data,
         contentType: false,
         cache: false,
         processData: false,
         success: function(result) {
           $('#preview_cover').remove();
           $('#album_cover').val('');
           $('#message_images').html('<span class="text-success">Image removed.</span>');
           $('#cover').val('');
         }
       });
    }

    $(document).on('click', '.remove_image', function(event) {
      event.preventDefault();
      var path = $(this).attr('data-path');
      remove_cover_photo(path);
    });
  });
</script>
@endsection
