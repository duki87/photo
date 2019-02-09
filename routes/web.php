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
Route::get('/gallery', 'FrontController@gallery')->name('front.gallery');

Route::post('/add-shooting', 'ShootingController@create')->name('front.add-shooting');

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
Route::group(['middleware' => 'auth'], function() {
  Route::get('/admin-area', 'HomeController@index')->name('admin.index');
  Route::get('/admin-area/add-photos', 'PhotoController@index')->name('admin.add-photos');

  Route::get('/admin-area/albums', 'AlbumController@index')->name('admin.albums');
  Route::get('/admin-area/edit-album/{id}', 'AlbumController@edit')->name('admin.edit-album');
  Route::post('/admin-area/update-album', 'AlbumController@update')->name('admin.update-album');
  Route::post('/admin-area/add-cover-photo', 'AlbumController@preview_cover')->name('admin.add-cover-photo');
  Route::post('/admin-area/remove-cover-photo', 'AlbumController@remove_cover')->name('admin.remove-cover-photo');
  // Route::post('/edit-album/remove-cover-photo', 'AlbumController@remove_cover');
  Route::post('/admin-area/add-new-album', 'AlbumController@store')->name('admin.add-new-album');
  Route::get('/admin-area/shootings', 'ShootingController@index')->name('admin.shootings');
  Route::get('/admin-area/change-shooting-status/{id}', 'ShootingController@change_status')->name('admin.change-shooting-status');
  Route::post('/admin-area/upload-photos', 'PhotoController@store')->name('admin.upload-photos');
  Route::post('/admin-area/remove-photo', 'PhotoController@destroy')->name('admin.remove-photo');
});
