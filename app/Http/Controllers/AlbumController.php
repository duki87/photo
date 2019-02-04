<?php

namespace App\Http\Controllers;

use App\Album;
use Illuminate\Http\Request;
use Session;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
      $albums = Album::get();
      return view('admin.albums')->with(['albums' => $albums, 'page_name' => 'albums']);
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
        $cover = '';
        if($request->cover == '') {
          $cover = 'default.jpg';
        } else {
          $cover = $request->cover;
        }
        $album = new Album();
        $album->title = $request->title;
        $album->description = $request->description;
        $album->cover = $cover;

        if($album->save()) {
          return redirect()->back()->with(['album_message' => 'Album '.$request->title.' added.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function show(Album $album)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $album = Album::where(['id' => $id])->first();
      return view('admin.edit-album')->with(['album' => $album, 'page_name' => 'edit-album']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) {
      $cover = '';
      if($request->cover == '') {
        $cover = 'default.jpg';
      } else {
        $cover = $request->cover;
      }
      $cover =
      Album::where(['id' => $request->id])->update([
        'title'=>$request->title,
        'description'=>$request->description,
        'cover'=>$cover
      ]);
      return redirect('/admin-area/albums')->with(['album_message' => 'Album '.$request->title.' edited.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function destroy(Album $album)
    {
        //
    }

    public function preview_cover(Request $request) {
      $image = $request->file('album_cover');
      $extension = $request->file('album_cover')->getClientOriginalExtension(); // getting excel extension
      $dir = 'img/album_covers/';
      $filename = uniqid().'_'.time().'_'.date('Ymd').'.'.$extension;
      $move = $request->file('album_cover')->move($dir, $filename);
      $file_path = url('/').'/img/album_covers/'.$filename;
      if($move) {
        return response()->json(['filename'=>$filename, 'image_path'=>$file_path]);
      }
    }

    public function remove_cover(Request $request) {
      $file_path = public_path().'/img/album_covers/'.$request->path;
      $unlink = unlink($file_path);
      if($unlink) {
        return response()->json(['message'=>'IMG_DELETE']);
      }
    }
}
