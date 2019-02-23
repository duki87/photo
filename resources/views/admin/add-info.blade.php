@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h2 style="color:white">Dodaj fotografije</h2>
      <div class="" id="message">

      </div>
      <hr style="background-color: yellow; height: 1px; border: 0;">
    </div>
    <div class="row" id="photos">
      @foreach($cards as $card)
      <div class="col-md-3 mt-2 cards" id="{{$card['id']}}">
         <div class="card" style="background-color:rgba(255,255,255,0.3)" style="width:100%">
           <img class="card-img-top" src="{{asset('img/albums/'.$card['directory'].'/'.$card['name'])}}" alt="" style="object-fit:cover">
           <div class="card-body">
             <input type="hidden" class="form-control mt-2" name="photo_id[]" value="{{$card['id']}}">
             <input type="text" class="form-control mt-2" name="title[]" value="" placeholder="Naziv">
             <input type="text" class="form-control mt-2" name="location[]" value="" placeholder="Lokacija">
             <textarea class="form-control mt-2" name="description[]" value="" placeholder="Opis"></textarea>
             <input type="hidden" class="form-control filenames" name="filename[]" value="'.$name.'">
             <a href="{{route('admin.remove-photo')}}" class="btn btn-danger mt-2 remove-photo" data-photo_id="{{$card['id']}}" style="width:100%"  ><i class="fas fa-times-circle"></i> Izbaci</a>
           </div>
         </div>
       </div>
      @endforeach
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    //remove specified photo
    $(document).on('click', '.remove-photo', function(e) {
      e.preventDefault();
      var photo = $(this).attr('data-photo_id');
      var id = $(this).parent().parent().parent().attr('id');
      console.log(id);
      const form_data = new FormData();
      form_data.append('photo_id', photo);
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
             var message =
             '<div id="message" class="alert alert-warning alert-dismissible fade show mt-2" role="alert">'+
                '<strong id="">Info</strong> Fotogorafija obrisana.'+
                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'+
                   '<span aria-hidden="true">&times;</span>'+
                '</button>'+
             '</div>';
             $('#message').html(message);
             $('#'+id).remove();
             if($('.cards').length < 1) {
               window.location.href = '{{route("admin.index")}}';
             }
           }
         }
       });
    });
  });
</script>
@endsection
