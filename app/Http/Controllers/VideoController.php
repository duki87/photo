<?php

namespace App\Http\Controllers;

use App\Video;
use Illuminate\Http\Request;
use Storage;
use Illuminate\Support\Facades\File;
use Validator;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $videos = Video::paginate(6);
        return view('admin.videos')->with(['page_name' => 'videos', 'videos' => $videos]);
    }

    public function add_videos() {
        return view('admin.add-videos')->with(['page_name' => 'add-videos']);
    }

    public function upload_video(Request $request) {
        $validator = Validator::make(
           array('video' => $request->video),
           array('video' => 'required|max:100000')
        );
        $video = $request->video;
        $tmp_name = $video->getClientOriginalName();
        $extension = $video->getClientOriginalExtension();
        // if($validator->fails()) {
        //   $validatorErrors[] = $tmp_name.'.'.$extension.' => '.$validator->getMessageBag()->first();
        //   continue;
        // }
        //$name = substr( base_convert( time(), 10, 36 ) . md5( microtime() ), 0, 16 ).'.'.$extension;
        $storagePath = Storage::disk('public_folder')->putFile('videos', $video);
        $video = new Video();
        $video->title = $request->title;
        $video->description = $request->description;
        $video->filename = basename($storagePath);
        $save = $video->save();
        if($save) {
          return redirect('/admin-area/videos')->with(['video_message' => 'Video fajl je uspesno otpremljen.']);
        }
    }

    public function update(Request $request) {
      $video = Video::where(['id' => $request->id])->first();
      Video::where(['id' => $request->id])->update([
        'title'=>$request->title,
        'description'=>$request->description
      ]);
      return redirect()->back()->with(['video_message' => 'Podaci o video fajlu su uspesno izmenjeni.']);
    }

    public function destroy($id){
      $video = Video::where(['id' => $id])->first();
      $filename = $video->filename;
      $remove = Storage::disk('public_folder')->delete('videos/'.$filename);
      if($remove) {
        $db_remove = Video::where(['id' => $id])->delete();
        if($db_remove) {
          return redirect()->back()->with(['video_message' => 'Fajl je uspesno obrisan.']);
        } else {
          return redirect()->back()->with(['video_message_error' => 'Problem prilikom brisanja. Pokusajte ponovo.']);
        }
      } else {
        return redirect()->back()->with(['video_message_error' => 'Problem prilikom brisanja. Pokusajte ponovo.']);
      }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {
        //
    }

}
