<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('index');
// }); 
Route::get('/', 'FrontController@index')->name('front.index');
Route::get('/albums', 'FrontController@albums')->name('front.albums');
Route::get('/albums/{id}', 'FrontController@gallery')->name('front.gallery');
Route::get('/video', 'FrontController@videos')->name('front.videos');

Route::post('/add-shooting', 'ShootingController@create')->name('front.add-shooting');
Route::get('/blog', 'FrontController@blogs')->name('front.blogs');
Route::get('/blog/{url}', 'FrontController@get_blog_text')->name('front.blog');
Route::get('/blog/error', 'FrontController@error')->name('front.error');

Auth::routes();

Route::group(['middleware' => 'auth'], function() {
  Route::get('/admin-area', 'HomeController@index')->name('admin.index');
  Route::get('/admin-area/info', 'HomeController@info')->name('admin.info');
  //Albums routes
  Route::get('/admin-area/albums', 'AlbumController@index')->name('admin.albums');
  Route::get('/admin-area/add-album', 'AlbumController@add_album')->name('admin.add-album');
  Route::get('/admin-area/edit-album/{id}', 'AlbumController@edit')->name('admin.edit-album');
  Route::post('/admin-area/update-album', 'AlbumController@update')->name('admin.update-album');
  Route::post('/admin-area/add-cover-photo', 'AlbumController@preview_cover')->name('admin.add-cover-photo');
  Route::post('/admin-area/remove-cover-photo', 'AlbumController@remove_cover')->name('admin.remove-cover-photo');
  Route::post('/admin-area/add-new-album', 'AlbumController@store')->name('admin.add-new-album');
  Route::get('/admin-area/remove-album/{id}', 'AlbumController@destroy')->name('admin.remove-album');
  //Shootings routes
  Route::get('/admin-area/shootings', 'ShootingController@index')->name('admin.shootings');
  Route::get('/admin-area/change-shooting-status/{id}', 'ShootingController@change_status')->name('admin.change-shooting-status');
  //Photo routes
  Route::get('/admin-area/add-photos', 'PhotoController@index')->name('admin.add-photos');
  Route::post('/admin-area/remove-photo', 'PhotoController@destroy')->name('admin.remove-photo');
  Route::post('/admin-area/edit-photo', 'PhotoController@update')->name('admin.edit-photo');
  Route::post('/admin-area/remove-uploads', 'PhotoController@remove_uploads')->name('admin.remove-uploads');
  Route::get('/admin-area/edit-photos/{album_id}', 'PhotoController@edit_photos')->name('admin.edit-photos');
  Route::get('/admin-area/clear-album/{id}', 'PhotoController@clear_album')->name('admin.clear-album');
  Route::post('/admin-area/remove-photo-from-album', 'PhotoController@destroy_photo_from_album')->name('admin.remove-photo-from-album');
  Route::post('/admin-area/upload-photos', 'PhotoController@upload_photos')->name('admin.upload-photos');
  Route::get('/admin-area/add-info')->name('admin.add-info');
  Route::post('/admin-area/add-info', 'PhotoController@add_info')->name('admin.add-info');
  //Video routes
  Route::get('/admin-area/add-videos', 'VideoController@add_videos')->name('admin.add-videos');
  Route::get('/admin-area/videos', 'VideoController@index')->name('admin.videos');
  Route::post('/admin-area/upload-video', 'VideoController@upload_video')->name('admin.upload-video');
  Route::post('/admin-area/edit-video', 'VideoController@update')->name('admin.edit-video');
  Route::get('/admin-area/remove-video/{id}', 'VideoController@destroy')->name('admin.remove-video');
  //Cleaner routes
  Route::get('/admin-area/cleaner', 'PhotoController@cleaner')->name('admin.cleaner');
  Route::post('/admin-area/clean-folder', 'PhotoController@clean_folder')->name('admin.clean-folder');
  //Blog routes
  Route::get('/admin-area/blog', 'BlogController@index')->name('admin.blog');
  Route::get('/admin-area/add-blog', 'BlogController@add_blog')->name('admin.add-blog');
  Route::post('/admin-area/create-blog', 'BlogController@create')->name('admin.create-blog');
  Route::get('/admin-area/remove-blog/{id}', 'BlogController@destroy')->name('admin.remove-blog');
  Route::get('/admin-area/edit-blog/{id}', 'BlogController@edit')->name('admin.edit-blog');
  Route::post('/admin-area/remove-blog-photo', 'BlogController@remove_photo')->name('admin.remove-blog-photo');
  Route::post('/admin-area/add-more-blog-photos', 'BlogController@add_more_photos')->name('admin.add-more-blog-photos');
  Route::post('/admin-area/update-blog', 'BlogController@update_blog')->name('admin.update-blog');
  //Profile and update profile routes
  Route::get('/admin-area/profile', 'HomeController@profile')->name('admin.profile');
  Route::post('/admin-area/update-profile', 'Auth\UpdateProfileController@update_profile')->name('admin.update-profile');
  Route::post('/admin-area/change-password', 'Auth\UpdatePasswordController@change_password')->name('admin.change-password');
});
