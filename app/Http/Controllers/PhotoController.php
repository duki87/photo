<?php

namespace App\Http\Controllers;

use App\Photo;
use App\Album;
use Illuminate\Http\Request;
use Storage;
use Illuminate\Support\Facades\File;

class PhotoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
      $albums = Album::get();
      return view('admin.add-photos')->with(['page_name' => 'add-photos', 'albums' => $albums]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
      $imagesArr = array();
      $cardArr = array();
      $extArray = ['jpg', 'gif', 'png', 'tiff'];
      $dir_id =
      $album = Album::where(['id' => $request->album])->first();
      $directory = $album->title;
      $images = $request->file('images');
      foreach($images as $image){
        $tmp_name = $image->getClientOriginalName();
        $tmp_namee = explode('.', $tmp_name);
        $id = $tmp_namee[0];
        $extension = $image->getClientOriginalExtension();

        if(!in_array($extension, $extArray)) {
          continue;
        }
        $storagePath = Storage::disk('uploads')->put($directory, $image);
        $imagesArr[] = basename($storagePath);
        $cardArr[] = '<div class="col-md-4 mt-2" id="'.$id.'">
                       <div class="card" style="background-color:rgba(255,255,255,0.3)" style="width:100%">
                         <img class="card-img-top" src="'.asset('img/albums/'.$directory.'/'.basename($storagePath)).'" alt="" style="width:100%">
                         <div class="card-body">
                           <input type="text" class="form-control mt-2" name="title[]" id="title" value="" placeholder="Naziv">
                           <input type="text" class="form-control mt-2" name="location[]" id="location" value="" placeholder="Lokacija">
                           <textarea class="form-control mt-2" name="description[]" id="location" value="" placeholder="Opis"></textarea>
                           <input type="hidden" class="form-control" name="filename[]" id="filename" value="">
                           <a href="'.route('admin.remove-photo').'" class="btn btn-danger mt-2 remove-photo" data-photo="'.basename($storagePath).'" data-album="'.$directory.'" style="width:100%"  ><i class="fas fa-times-circle"></i> Izbaci</a>
                         </div>
                       </div>
                     </div>';
      }
      return response()->json(['cards' => $cardArr]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function show(Photo $photo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function edit(Photo $photo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Photo $photo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Photo  $photo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request) {
      $photo = $request->photo;
      $album = $request->album;
      $remove = Storage::disk('uploads')->delete($album.'/'.$photo);
      return response()->json(['success' => 'PHOTO_REMOVE']);
    }
}
