@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h2 style="color:white">Izmeni tekst: <b style="color:yellow">{{$blog->title}}</b></h2>
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
      <form id="add-blog" class="row" action="{{route('admin.update-blog')}}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="form-group col-md-6">
            <label for="" style="color:white">Naslov teksta</label>
            <input type="text" name="title" id="title" class="form-control" placeholder="Unesi naslov teksta" value="{{$blog->title}}" required>
          </div>
          <div class="form-group col-md-6">
            <label for="" style="color:white">Ime autora</label>
            <input type="text" name="author" id="author" class="form-control" placeholder="Unesi ime autora" value="{{$blog->author}}" required>
          </div>
         <div class="col-md-12 mt-2">
           <!-- Create the editor container -->
           <!-- <div id="editor" style="background-color:white; height:500px">

           </div> -->
           <label for="" style="color:white">Tekst bloga</label>
           <textarea name="text" id="text" class="form-control" style="height:450px">{{$blog->text}}</textarea>
         </div>
          <div class="col-md-12 mt-2">
           <span style="color:yellow">Fotografije (Klikom na fotografiju oznacite naslovnu fotografiju)</span>
           <div class="row" id="blog_photos" style="position:relative">
             @foreach($blog->images as $image)
             <div id="{{$image->id}}" class="col-md-3 mt-2 {{$image->image == $blog->cover_image ? 'cover-border' : ''}} blog-image" style="position:relative" data-photo="{{$image->image}}">
               <img class="" src="{{asset('img/blog/'.$image->image)}}" data-img="{{$image->image}}" alt="" style="object-fit:cover; width:100%; height:150px">
               <button type="button" class="btn btn-danger remove_photo" style="position:absolute; top:10px; right:20px" name="button" data-remove="{{$image->id}}">x</button>
             </div>
             @endforeach
           </div>
         </div>
          <div class="col-md-6 mt-2">
            <label for="" style="color:white">Dodaj jos fotografija</label>
            <div class="custom-file">
              <input type="hidden" name="blog_id" id="blog_id" value="{{$blog->id}}">
              <input type="hidden" name="cover_photo" id="cover_photo" value="">
              <input type="hidden" name="folder_name" id="folder_name" value="{{$folder}}">
              <input type="file" class="custom-file-input" id="photos" name="photos[]" multiple>
              <label class="custom-file-label" for="customFile">Fotografije</label>
              <p id="message_images" class="text-danger d-none"></p>
            </div>
          </div>
          <div class="col-md-12 mt-2">
            <span style="color:yellow">Pregled fotografija (ako ste zadovoljni kliknite na "Upload")<i></i> </span>
            <div class="row" id="preview_photos" style="position:relative">

            </div>
            <button type="button" id="upload_photos" class="btn btn-warning mt-2 d-none" name="upload_photos">
              <span id="spinner_upload" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
              <span id="btntext_upload" class="">Upload</span>
            </button>
          </div>
         <div class="form-group col-md-12">
           <button type="submit" id="submit-btn" class="btn btn-success mt-5" name="submit">
             <span id="spinner" class="spinner-border spinner-border-sm d-none" role="status" aria-hidden="true"></span>
             <span id="btntext" class="">Izmeni tekst</span>
           </button>
         </div>
      </form>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    var storedFiles = [];
    $(document).on('click', '.remove_photo', function(e) {
      e.preventDefault();
      var remove = $(this).attr('data-remove');
      var form_data = new FormData();
      form_data.append('id', remove);
      $.ajaxSetup({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
     });
      $.ajax({
         url: "{{url('admin-area/remove-blog-photo')}}",
         type: "POST",
         data: form_data,
         dataType: 'json',
         contentType: false,
         cache: false,
         processData: false,
         success: function(result) {
           if(result.success == 'PHOTO_REMOVE') {
             $('#'+remove).remove();
             $('#message_images').removeClass('d-none');
             $('#message_images').html("Fotografija je uspesno obrisana.");
             var blogImageLength = $('.blog-image').length;
             console.log(blogImageLength);
             if(blogImageLength < 1) {
               $('#message_images').html("Obrisali ste sve fotografije. Morate dodati bar jednu fotografiju!");
               $('#submit-btn').prop('disabled', true);
             }
           }
         }
       });
    });

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
            '<div class="col-md-2 ml-2 mt-2" style="position:relative" data-photo="'+cover_photo+'">'+
              '<img src="'+reader.result+'" class="rounded" alt="..." style="width:100%; height:100%; object-fit:cover">'+
            '</div>';
            $('#preview_photos').append(card);
            $('#upload_photos').removeClass('d-none');
          }
          reader.readAsDataURL(photo);
        } else {
          $('#message_images').removeClass('d-none');
          $('#message_images').html("Fajlovi nedozvoljene ekstenzije su iskljuceni!");
        }
      }
    });

    $(document).on('click', '.blog-image', function(e) {
      e.preventDefault();
      let cover = $(this).attr('data-photo');
      $('#cover_photo').val(cover);
      checkClass();
      $(this).addClass('cover-border');
    });

    $(document).on('click', '#submit-btn', function(e) {
      //console.log('dsfsf');
      $('#btntext').html('Ucitavanje...');
      $('#spinner').removeClass('d-none');
    });

    $(document).on('click', '#upload_photos', function(e) {
      $('#btntext_upload').html('Ucitavanje...');
      $('#spinner_upload').removeClass('d-none');
      e.preventDefault();
      var images = document.getElementById('photos').files;
      var form_data = new FormData();
      //console.log(images);
      for(let i=0; i<images.length; i++) {
        form_data.append('files[]', images[i]);
      }
      let folder = $('#folder_name').val();
      let blog_id = $('#blog_id').val();
      form_data.append('folder_name', folder);
      form_data.append('blog_id', blog_id);
      console.log(form_data);
      $.ajaxSetup({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
     });
      $.ajax({
         url: "{{url('admin-area/add-more-blog-photos')}}",
         type: "POST",
         data: form_data,
         dataType: 'json',
         contentType: false,
         cache: false,
         processData: false,
         success: function(result) {
           for(let image of result.success) {
             let card = '<div id="'+image.id+'" class="col-md-3 mt-2 blog-image" style="position:relative" data-photo="'+image.image+'">'+
                           '<img class="" src="'+image.src+'" data-img="'+image.image+'" alt="" style="object-fit:cover; width:100%; height:150px">'+
                           '<button type="button" class="btn btn-danger remove_photo" style="position:absolute; top:10px; right:20px" name="button" data-remove="'+image.id+'">x</button>'+
                         '</div>';
             $('#blog_photos').append(card);
           }
           $('#message_images').removeClass('d-none');
           $('#message_images').html('Fotografije su uploadovane.');
           $('#btntext_upload').html('Upload');
           $('#spinner_upload').addClass('d-none');
           $('#upload_photos').addClass('d-none');
           $('#submit-btn').prop('disabled', false);
           $('#preview_photos').html('');
           $('#photos').val('');
         }
       });
    });

    function checkClass() {
      var arr = $('.cover-border');
      if(arr.length > 0) {
        for(let f=0; f<arr.length; f++) {
          arr[f].classList.remove('cover-border');
        }
      }
    }
});
</script>

@endsection
