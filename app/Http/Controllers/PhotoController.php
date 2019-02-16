<?php

namespace App\Http\Controllers;

use App\Photo;
use App\Album;
use Illuminate\Http\Request;
use Storage;
use Illuminate\Support\Facades\File;
use Image;

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

    public function cleaner() {
      $albums = Album::get();
      return view('admin.cleaner')->with(['page_name' => 'cleaner', 'albums' => $albums]);
    }

    public function edit_photos($album_id) {
      $albums = Album::get();
      $album = Album::where(['id' => $album_id])->first();
      $directory = $album->title;
      $photos = Photo::where(['album'=>$album_id])->get();
      return view('admin.edit-photos')->with(['page_name' => 'edit-photos', 'photos' => $photos, 'album'=>$directory, 'albums' => $albums]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request) {
      foreach ($request->filename as $key=>$value) {
        //$image = json_decode($data, true);
        $photo = new Photo;
        $photo->title = $request->title[$key];
        $photo->description = $request->description[$key];
        $photo->location = $request->location[$key];
        $photo->album = $request->album;
        $photo->filename = $value;
        $photo->save();
      }
      return redirect()->back()->with(['photo_message' => 'fotografije su dodate u album.']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
      $watermark = ('img/watermark.png');
      $imagesArr = array();
      $cardArr = array();
      $extArray = ['jpg', 'gif', 'png', 'tiff', 'jpeg'];
      $dir_id =
      $album = Album::where(['id' => $request->album])->first();
      $directory = $album->title;
      $images = $request->file('images');
      foreach($images as $image){
        $tmp_name = $image->getClientOriginalName();
        $extension = $image->getClientOriginalExtension();
        $name = substr( base_convert( time(), 10, 36 ) . md5( microtime() ), 0, 16 ).'.'.$extension;
        if(!in_array($extension, $extArray)) {
          continue;
        }
        $photo = Image::make($image)
                  ->resize(1024, null, function ($constraint) {
                    $constraint->aspectRatio();
                  })
                  ->insert($watermark, 'bottom-left', 10, 10)
                  ->save('img/albums/'.$directory.'/'.$name);

        //Try to find out how to implement upload using storage facade - there is
        //a problem to store image this way after using image intervention

        //$storagePath = Storage::disk('uploads')->put($directory, $photo);
        //$imagesArr[] = basename($storagePath);
        $imagesArr[] = $name;
        $tmp_namee = explode('.', $name);
        $id = $tmp_namee[0];
        $cardArr[] = '<div class="col-md-4 mt-2" id="'.$id.'">
                       <div class="card" style="background-color:rgba(255,255,255,0.3)" style="width:100%">
                         <img class="card-img-top" src="'.asset('img/albums/'.$directory.'/'.$name).'" alt="" style="width:100%">
                         <div class="card-body">
                           <input type="text" class="form-control mt-2" name="title[]" id="title" value="" placeholder="Naziv">
                           <input type="text" class="form-control mt-2" name="location[]" id="location" value="" placeholder="Lokacija">
                           <textarea class="form-control mt-2" name="description[]" id="location" value="" placeholder="Opis"></textarea>
                           <input type="hidden" class="form-control filenames" name="filename[]" id="filename" value="'.$name.'">
                           <a href="'.route('admin.remove-photo').'" class="btn btn-danger mt-2 remove-photo" data-photo="'.$name.'" data-album="'.$directory.'" style="width:100%"  ><i class="fas fa-times-circle"></i> Izbaci</a>
                         </div>
                       </div>
                     </div>';
      }
      return response()->json(['cards' => $cardArr, 'imagesArr' => $imagesArr]);
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

    public function clean_folder(Request $request) {
      $count = 0;
      $album = Album::where(['id' => $request->album])->first();
      $directory = $album->title;
      $files = Storage::disk('uploads')->files($directory);
      foreach ($files as $file) {
        $explode = explode('/', $file);
        $img = $explode[1];
        $db = Photo::where(['filename' => $img])->first();
        if($db === null) {
          Storage::disk('uploads')->delete($directory.'/'.$img);
          $count++;
        }
      }
      $message = '';
      if($count < 1) {
        $message = 'Ciscenje zavrseno. Nije pronadjena nijedna nepovezana datoteka.';
      } else {
        $message = 'Ciscenje zavrseno. Obrisano je '.$count.' fajlova.';
      }
      return redirect()->back()->with(['cleaner_message' => $message]);
    }

    public function remove_uploads(Request $request) {
      $album = Album::where(['id' => $request->album])->first();
      $directory = $album->title;
      foreach ($request->filenames as $filename) {
        Storage::disk('uploads')->delete($directory.'/'.$filename);
      }
      return response()->json(['success' => 'REMOVE_UPLOADS']);
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
