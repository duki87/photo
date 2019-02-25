@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h2 style="color:white">Izmeni fotografije u albumu <b style="color:yellow">{{$album->title}} ({{count($album->photos)}} fotogorafija)</b></h2>
      <a onclick="return confirm('Da li ste sigurni da zelite da obrisete sve fotografije iz ovog albuma?')" href="{{route('admin.clear-album', $album->id)}}" class="btn btn-danger remove_all {{count($album->photos) < 1 ? 'd-none':''}}" id="remove-all"><i class="fas fa-trash-alt"></i> Obrisi sve fotografije</a>
      <a href="{{route('admin.add-photos')}}" class="btn btn-success {{count($album->photos) < 1 ? '':'d-none'}}" id="add-photos">Album je sada prazan - dodaj nove fotografije</a>
      <div class="mt-2" id="message" style=""></div>
      <hr style="background-color: yellow; height: 1px; border: 0;">
    </div>
    <div class="col-md-12">
      <div id="preview" class="row">
      @foreach($album->photos as $photo)
        <div class="col-md-2 mt-2" id="{{$photo->id}}" style="position:relative">
          <button type="button" name="remove_button" data-photo="{{$photo->id}}" data-album="{{$album->id}}" class="btn btn-danger btn-sm remove-photo" style="position:absolute; top:5px; right:22px">X</button>
          <a href="" type="" class="details" data-toggle="modal" data-target="#details{{$photo->id}}"><img src="{{asset('img/albums/'.$directory.'/'.$photo['filename'])}}" style="object-fit:cover" width="100%" alt="..." class="img-thumbnail"></a>
        </div>
      @endforeach
      </div>
    </div>
  </div>
</div>

<!-- Modal -->
@foreach($album->photos as $photo)
<div class="modal fade" id="details{{$photo->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form method="post" class="edit-photo" data-photo="{{$photo->id}}">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><img src="{{asset('img/albums/'.$directory.'/'.$photo->filename)}}" width="70px" alt="..." class="img-thumbnail"> Izmeni fotografiju</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group">
            <input type="text" name="title" id="title{{$photo->id}}" class="form-control title" value="{{$photo->title}}">
          </div>
          <div class="form-group">
            <textarea name="description" id="description{{$photo->id}}" class="form-control description">{{$photo->description}}</textarea>
          </div>
          <div class="form-group">
            <input type="text" name="location" id="location{{$photo->id}}" class="form-control location" value="{{$photo->location}}">
          </div>
          <div class="form-group">
            <select class="form-control album" id="album{{$photo->id}}" name="album" value="{{$photo->album}}">
              @foreach($albums as $album)
                <option <?=($album->id == $photo->album ? 'selected' : '');?> value="{{$album->id}}">{{$album->title}}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success submit-form" data-dismiss="modal">Izmeni</button>
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
    $(document).on('click', '.submit-form', function(e) {
      e.preventDefault();
      //alert($(this).closest('.edit-photo').attr('data-photo'));
      const form_data = new FormData();
      var photo = $(this).closest('.edit-photo').attr('data-photo');
      var title = $('#title'+photo).val();
      var description = $('#description'+photo).val();
      var album = $('#album'+photo).val();
      console.log(photo+''+title+''+description+''+album);
      form_data.append('id', photo);
      form_data.append('title', title);
      form_data.append('description', description);
      form_data.append('album', album);
      $.ajaxSetup({
         headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
     });
      $.ajax({
         url: "{{url('admin-area/edit-photo')}}",
         type: "POST",
         data: form_data,
         dataType: 'json',
         contentType: false,
         cache: false,
         processData: false,
         success: function(result) {
           var message =
           '<div id="message" class="alert alert-warning alert-dismissible fade show mt-2" role="alert">'+
              '<strong id="">Info</strong>'+result.success+
              '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                 '<span aria-hidden="true">&times;</span>'+
              '</button>'+
           '</div>';
           $('#message').html(message);
           if(result.move == true) {
             $('#'+photo).remove();
             $('#details'+photo).remove();
           }
         }
       });
    });

    //remove specified photo
    $(document).on('click', '.remove-photo', function(e) {
      e.preventDefault();
      if(confirm('Da li ste sigurni da zelite da obrisete ovu fotografiju?')) {
        var photo = $(this).attr('data-photo');
        var album = $(this).attr('data-album');
        const form_data = new FormData();
        form_data.append('photo', photo);
        form_data.append('album', album);
        $.ajaxSetup({
           headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
       });
        $.ajax({
           url: "{{url('admin-area/remove-photo-from-album')}}",
           type: "POST",
           data: form_data,
           dataType: 'json',
           contentType: false,
           cache: false,
           processData: false,
           success: function(result) {
             if(result.success == 'PHOTO_REMOVE') {
               var message =
               '<div id="message" class="alert alert-warning alert-dismissible fade show mt-2" role="alert">'+
                  '<strong id="">Info</strong> Fotogorafija obrisana.'+
                  '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                     '<span aria-hidden="true">&times;</span>'+
                  '</button>'+
               '</div>';
               $('#message').html(message);
               $('#'+photo).remove();
               $('#details'+photo).remove();
             }
             if(result.success == 'EMPTY') {
               $('#'+photo).remove();
               $('#details'+photo).remove();
               $('#remove-all').addClass('d-none');
               $('#add-photos').removeClass('d-none');
             }
           }
         });
      } else {
        return false;
      }
    });

  });
</script>
@endsection
