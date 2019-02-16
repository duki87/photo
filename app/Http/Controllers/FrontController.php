<?php

namespace App\Http\Controllers;

use App\Album;
use Illuminate\Http\Request;

class FrontController extends Controller
{
  public function index() {
    return view('index')->with(['page_name' => 'index']);
  }

  public function gallery($id) {
    $album = Album::where(['id' => $id])->with('photos')->first();
    return view('gallery')->with(['page_name' => 'gallery', 'album' => $album]);
  }

  public function albums() {
    $albums = Album::get();
    return view('albums')->with(['page_name' => 'albums', 'albums' => $albums]);
  }
}
