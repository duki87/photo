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
    public function store(Request $request) {
      $imagesArr = array();
      $extArray = ['jpg', 'gif', 'png', 'tiff'];
      $dir_id =
      $album = Album::where(['id' => $request->album])->first();
      $directory = $album->title;
      $images = $request->file('images');
      foreach($images as $image){
        $tmp_name = $image->getClientOriginalName();
        $extension = $image->getClientOriginalExtension();
        if(!in_array($extension, $extArray)) {
          continue;
        }
        $storagePath = Storage::disk('uploads')->put($directory, $image);
        $imagesArr[] = basename($storagePath);
      }
      return response()->json(['images' => $imagesArr]);
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
    public function destroy(Photo $photo)
    {
        //
    }
}
