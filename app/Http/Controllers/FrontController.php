<?php

namespace App\Http\Controllers;

use App\Album;
use App\Video;
use App\Blog;
use Illuminate\Http\Request;

class FrontController extends Controller
{
  public function index() {
    $blogs = Blog::orderBy('created_at', 'desc')->take(3)->get();
    return view('index')->with(['page_name' => 'index', 'blogs' => $blogs]);
  }

  public function gallery($id) {
    $album = Album::where(['id' => $id])->with('photos')->first();
    return view('gallery2')->with(['page_name' => 'gallery', 'album' => $album]);
  }

  public function albums() {
    $albums = Album::with('photos')->get();
    foreach ($albums as $key => $album) {
      if(count($album->photos) < 1) {
        unset($albums[$key]);
      }
    }
    return view('albums')->with(['page_name' => 'albums', 'albums' => $albums]);
  }

  public function videos() {
    $videos = Video::get();
    return view('videos')->with(['page_name' => 'videos', 'videos' => $videos]);
  }

  public function blogs() {
    $blogs = Blog::get();
    return view('blog')->with(['page_name' => 'blog', 'blogs' => $blogs]);
  }

  public function get_blog_text($url) {
    $blog = Blog::where(['url' => $url])->with('images')->first();
    if(!$blog) {
      return redirect('/error');
    }
    return view('single-blog')->with(['page_name' => 'blog', 'blog' => $blog]);
  }

  public function error() {
    return view('errors.404');
  }
}
