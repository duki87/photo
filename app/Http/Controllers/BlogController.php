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

    public function edit($id) {
        $blog = Blog::where(['id' => $id])->with('images')->first();
        return view('admin.edit-blog')->with(['page_name' => 'blog', 'blog' => $blog]);
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

     public function destroy($id) {
        $blog = Blog::where(['id' => $id])->with('images')->first();
        $arr = explode('/', $blog->cover_image);
        $directory = $arr[0];
        foreach ($blog->images as $image) {
          Storage::disk('public_folder')->delete('img/blog/'.$image->image);
          BlogImages::where(['id' => $image->id])->delete();
        }
        Blog::where(['id' => $id])->delete();
        $folder_delete = Storage::disk('public_folder')->deleteDirectory('img/blog/'.$directory);
        if($folder_delete) {
          return redirect()->back()->with('blog_message', 'Tekst je uspesno obrisan.');
        } else {
          return redirect()->back()->with('blog_message_err', 'Doslo je do greske. Pokusajte ponovo.');
        }
     }

     public function remove_photo(Request $request) {
       $image = BlogImages::where(['id' => $request->id])->first();
       $removeImg = Storage::disk('public_folder')->delete('img/blog/'.$image->image);
       $removeData = BlogImages::where(['id' => $request->id])->delete();
       if($removeData) {
         return response()->json(['success' => 'PHOTO_REMOVE']);
       }
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
}
