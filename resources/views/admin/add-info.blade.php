@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-12">
      <h2 style="color:white">Dodaj fotografije</h2>
      @if(count($validatorErrors) > 0)
      <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Info</strong> Neki fajlovi nisu uploadovani na server iz sledecih razloga:
        <ul>
          @foreach($validatorErrors as $message)
            <li>{{$message}}</li>
          @endforeach
        </ul>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      @endif
      <form class="" action="{{route('admin.remove-uploads')}}" method="post">
        @csrf
        <input type="hidden" name="remove_album_id" value="{{$album_id}}">
        @foreach($cards as $card)
          <input type="hidden" name="remove_photo_id[]" value="{{$card['id']}}">
        @endforeach
        <button type="submit" name="button" onclick="return confirm('Da li ste sigurni da zelite da obrisete sve fotografije koje ste ucitali?')" class="btn btn-danger remove_all"><i class="fas fa-trash-alt"></i> Obrisi sve ucitane fotografije</button>
      </form>
      <div class="" id="message">

      </div>
      <hr style="background-color: yellow; height: 1px; border: 0;">
    </div>
    <form class="" action="{{route('admin.add-info')}}" method="post">
      @csrf
      <div class="row" id="photos">
        @foreach($cards as $card)
        <div class="col-md-3 mt-2 cards" id="{{$card['id']}}">
           <div class="card" style="background-color:rgba(255,255,255,0.3)">
             <img class="card-img-top" src="{{asset('img/albums/'.$card['directory'].'/'.$card['name'])}}" style="object-fit:cover; width:100%; height:200px;">
             <div class="card-body">
               <input type="hidden" class="form-control mt-2" name="photo_id[]" value="{{$card['id']}}">
               <input type="text" class="form-control mt-2" name="title[]" value="" placeholder="Naziv">
               <input type="text" class="form-control mt-2" name="location[]" value="" placeholder="Lokacija">
               <textarea class="form-control mt-2" name="description[]" value="" placeholder="Opis"></textarea>
               <a href="{{route('admin.remove-photo')}}" class="btn btn-danger mt-2 remove-photo" data-photo_id="{{$card['id']}}" style="width:100%"  ><i class="fas fa-times-circle"></i> Izbaci</a>
             </div>
           </div>
         </div>
        @endforeach
        <div class="form-group col-md-12 mt-4">
          <button type="submit" name="button" class="btn btn-success"><i class="far fa-save"></i> Sacuvaj informacije o fotogorafijama</button>
        </div>
      </div>
    </form>
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
