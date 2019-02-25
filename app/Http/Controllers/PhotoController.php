<?php

namespace App\Http\Controllers;

use App\Photo;
use App\Album;
use Illuminate\Http\Request;
use Storage;
use Illuminate\Support\Facades\File;
use Validator;
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
      $album = Album::where(['id' => $album_id])->with('photos')->first();
      $directory = $album->title;
      return view('admin.edit-photos')->with(['page_name' => 'edit-photos', 'directory' => $directory, 'album' => $album, 'albums' => $albums]);
    }

    public function update(Request $request){
      $success = '';
      $photo = Photo::where(['id' => $request->id])->first();
      $old_album_id = $photo->album;
      Photo::where(['id' => $request->id])->update([
        'title'=>$request->title,
        'description'=>$request->description,
        'location'=>$request->location,
        'album'=>$request->album
      ]);
      if($request->album != $old_album_id) {
        $old_album = Album::where(['id' => $old_album_id])->first();
        $new_album = Album::where(['id' => $request->album])->first();
        $old_album_name = $old_album->title;
        $new_album_name = $new_album->title;
        Storage::disk('uploads')->move(
          $old_album_name.'/'.$photo->filename,
          $new_album_name.'/'.$photo->filename
        );
        $success = 'Fotogorafija je izmenjena i premestena iz albuma '.$old_album_name.' u album '.$new_album_name.'.';
        $move = true;
      } else {
        $success = 'Podaci o fotogorafiji su uspesno izmenjeni.';
        $move = false;
      }
      return response()->json(['success' => $success, 'move' => $move]);
    }

    public function add_info(Request $request) {
      foreach($request->photo_id as $key=>$value) {
        Photo::where(['id' => $request->photo_id[$key]])->update([
          'title'=>$request->title[$key],
          'description'=>$request->description[$key],
          'location'=>$request->location[$key]
        ]);
      }
      return redirect('/admin-area/albums')->with(['album_message' => 'Informacije o fotografijama su dodate.']);
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
      $album = Album::where(['id' => $request->remove_album_id])->first();
      $directory = $album->title;
      foreach($request->remove_photo_id as $id) {
        $photo = Photo::where(['id' => $id])->first();
        $filename = $photo->filename;
        Storage::disk('uploads')->delete($directory.'/'.$filename);
        Photo::where(['id' => $id])->delete();
      }
      return redirect('/admin-area/add-photos')->with(['photo_message' => 'Sve ucitane fotografije su uspesno obrisane.']);
    }

    public function destroy(Request $request) {
      $photo = Photo::where(['id' => $request->photo_id])->first();
      $album = Album::where(['id' => $photo->album])->first();
      $title = $album->title;
      $filename = $photo->filename;
      $remove = Storage::disk('uploads')->delete($title.'/'.$filename);
      $delete = Photo::where(['id' => $request->photo_id])->delete();
      if($delete) {
        return response()->json(['success' => 'PHOTO_REMOVE']);
      }
    }

    public function destroy_photo_from_album(Request $request) {
      $success = '';
      $photo = Photo::where(['id' => $request->photo])->first();
      $album = Album::where(['id' => $request->album])->first();
      $title = $album->title;
      $remove = Storage::disk('uploads')->delete($title.'/'.$photo->filename);
      $photo->delete();
      $success = 'PHOTO_REMOVE';
      $photos = Photo::where(['album' => $request->album])->get();
      if(count($photos) < 1) {
        $success = 'EMPTY';
      }
      return response()->json(['success' => $success]);
    }

  private function location_name($lat, $long) {
    $url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=$lat,$long&key=AIzaSyBTk-8wPhCNjs4BE-vt0l9BRhZkGbBEFPY";
    $json = json_decode(file_get_contents($url), true);
    $a = $json['results'][0]['formatted_address'];
    $location = explode(",",$a);
    return $location;
  }

  public function clear_album($id) {
    $album = Album::where(['id' => $id])->with('photos')->first();
    $title = $album->title;
    foreach($album->photos as $photo) {
      Storage::disk('uploads')->delete($title.'/'.$photo->filename);
      $photo->delete();
    }
    $message = 'Sve fotogorafije u albumu '.$title.' su obrisane.';
    return redirect('/admin-area/albums')->with(['album_message' => $message]);
  }

  //New functions
  public function upload_photos(Request $request) {
    $watermark = ('img/watermark.png');
    $imagesArr = array();
    $geolocationArr = array();
    $cardArr = array();
    $extArray = ['jpg', 'gif', 'png', 'tiff', 'jpeg'];
    $dir_id =
    $album = Album::where(['id' => $request->album])->first();
    $directory = $album->title;
    $images = $request->file('photos');
    foreach($images as $image){
      $validator = Validator::make(
         array('photos' => $image),
         array('photos' => 'required|mimes:jpeg,png,jpg,gif|image|max:8000')
      );
      if ($validator->fails()) {
        return redirect()->back()->with('photo_message_err', $validator->getMessageBag()->first());
      }

      $tmp_name = $image->getClientOriginalName();
      $extension = $image->getClientOriginalExtension();
      $name = substr( base_convert( time(), 10, 36 ) . md5( microtime() ), 0, 16 ).'.'.$extension;
      // if($extension == 'jpeg' || $extension == 'jpg') {
      //   $geolocationArr[] = $this->read_gps_location($image);
      // }
      $photo = Image::make($image)
                ->resize(1024, null, function ($constraint) {
                  $constraint->aspectRatio();
                })
                ->insert($watermark, 'bottom-left', 10, 10)
                ->save('img/albums/'.$directory.'/'.$name);

      $imagesArr[] = $name;
      //$tmp_name_explode = explode('.', $name);
      $photo_db = new Photo;
      $photo_db->album = $request->album;
      $photo_db->filename = $name;
      $photo_db->save();

      //$div = $tmp_name_explode[0];
      $card['directory'] = $directory;
      $card['name'] = $name;
      $card['id'] = $photo_db->id;
      $cardArr[] = $card;
    }
    $album_id = $request->album;
    return view('admin.add-info')->with(['cards' => $cardArr, 'imagesArr' => $imagesArr, 'album_id' => $album_id]);
  }

  private function read_gps_location($file){
    if(is_file($file)) {
      if(exif_read_data($file)) {
        $info = exif_read_data($file);
        if (isset($info['GPSLatitude']) && isset($info['GPSLongitude']) &&
            isset($info['GPSLatitudeRef']) && isset($info['GPSLongitudeRef']) &&
            in_array($info['GPSLatitudeRef'], array('E','W','N','S')) && in_array($info['GPSLongitudeRef'], array('E','W','N','S'))) {

            $GPSLatitudeRef  = strtolower(trim($info['GPSLatitudeRef']));
            $GPSLongitudeRef = strtolower(trim($info['GPSLongitudeRef']));

            $lat_degrees_a = explode('/',$info['GPSLatitude'][0]);
            $lat_minutes_a = explode('/',$info['GPSLatitude'][1]);
            $lat_seconds_a = explode('/',$info['GPSLatitude'][2]);
            $lng_degrees_a = explode('/',$info['GPSLongitude'][0]);
            $lng_minutes_a = explode('/',$info['GPSLongitude'][1]);
            $lng_seconds_a = explode('/',$info['GPSLongitude'][2]);

            $lat_degrees = $lat_degrees_a[0] / $lat_degrees_a[1];
            $lat_minutes = $lat_minutes_a[0] / $lat_minutes_a[1];
            $lat_seconds = $lat_seconds_a[0] / $lat_seconds_a[1];
            $lng_degrees = $lng_degrees_a[0] / $lng_degrees_a[1];
            $lng_minutes = $lng_minutes_a[0] / $lng_minutes_a[1];
            $lng_seconds = $lng_seconds_a[0] / $lng_seconds_a[1];

            $lat = (float) $lat_degrees+((($lat_minutes*60)+($lat_seconds))/3600);
            $lng = (float) $lng_degrees+((($lng_minutes*60)+($lng_seconds))/3600);

            //If the latitude is South, make it negative.
            //If the longitude is west, make it negative
            $GPSLatitudeRef  == 's' ? $lat *= -1 : '';
            $GPSLongitudeRef == 'w' ? $lng *= -1 : '';
            return array(
                'lat' => $lat,
                'lng' => $lng
            );
            //return $this->location_name($lat, $lng);
        }
      } else {
        return 'no location';
      }
    }
  }
}
