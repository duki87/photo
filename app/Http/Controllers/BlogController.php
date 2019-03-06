<?php

namespace App\Http\Controllers;

use App\Blog;
use App\BlogImages;
use Illuminate\Http\Request;
use Storage;
use Illuminate\Support\Facades\File;
use Validator;
use Image;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
      $blogs = Blog::with('images')->paginate(6);
      return view('admin.blog')->with(['page_name' => 'blog', 'blogs' => $blogs]);
    }

    public function add_blog() {
        return view('admin.add-blog')->with(['page_name' => 'add-blog']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create(Request $request) {
       $watermark = 'img/watermark.png';
       $validatorErrors = array();
       $featured_photo = '';
       $featured = $request->cover_photo;
       $directory = 'blog' .'-'. substr( base_convert( time(), 10, 36 ) . md5( microtime() ), 0, 16 );
       Storage::disk('public_folder')->makeDirectory('img/blog/'.$directory);
       $url = strtolower($request->title);
       $url = str_replace(' ', '-', $url);
       $blog = new Blog;
       $blog->title = $request->title;
       $blog->text = $request->text;
       $blog->cover_image = $request->cover_photo;
       $blog->author = $request->author;
       $blog->url = $url;
       $blog->save();
       $id = $blog->id;

       $images = $request->file('photos');
       foreach($images as $image){
         $validator = Validator::make(
            array('photos' => $image),
            array('photos' => 'required|mimes:jpeg,png,jpg,gif|image|max:8000')
         );
         $tmp_name = $image->getClientOriginalName();
         $extension = $image->getClientOriginalExtension();
         if($validator->fails()) {
           $validatorErrors[] = $tmp_name.'.'.$extension.' => '.$validator->getMessageBag()->first();
           continue;
         }
         $name = substr( base_convert( time(), 10, 36 ) . md5( microtime() ), 0, 16 ).'.'.$extension;
         $photo = Image::make($image)
                   ->resize(1024, null, function ($constraint) {
                     $constraint->aspectRatio();
                   })
                   ->insert($watermark, 'bottom-left', 10, 10)
                   ->save('img/blog/'.$directory.'/'.$name);

         if($featured == $tmp_name) {
           $featured_photo = $directory.'/'.$name;
           Blog::where(['id' => $id])->update(['cover_image' => $featured_photo]);
         }
         $blogImages = new BlogImages;
         $blogImages->blog_id = $id;
         $blogImages->image = $directory.'/'.$name;
         $blogImages->save();
       }
       return redirect('/admin-area/blog')->with(['blog_message' => 'Tekst je uspesno dodat.']);
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
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $blog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blog $blog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blog $blog)
    {
        //
    }
}
