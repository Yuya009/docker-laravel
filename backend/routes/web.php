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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'PostsController@index');

Route::post('posts', 'PostsController@store');

Route::post('post/{post_id}', 'PostsController@favo');

//top画面表示
Route::get('top', 'PostsController@index_top');

//画像アップロードテスト用
//Route::get('img', )
Route::get('img', 'ImagesController@index');
//画像アップロードフォーム
//Route::get('/form', [App\Http\Controllers\UploadImageController::class, "show"])->name("upload_form");
Route::get('/form', 'UploadImageController@show')->name("upload_form");
//画像アップロード処理ページ
//Route::post('/upload', [App\Http\Controllers\UploadImageController::class, "upload"])->name("upload_image");
Route::post('/upload', 'UploadImageController@upload')->name("upload_image");
//画像表示処理
//Route::get('/list', [App\Http\Controllers\ImageListController::class, "show"])->name("image_list");
Route::get('/list', 'ImageListController@show')->name("imgae_list");

//投稿編集ページ
Route::get('postsedit/{post}', 'PostsController@edit');
//投稿編集アップデート
Route::post('posts/update', 'PostsController@update');

//投稿詳細ページ
Route::get('post/{post}', 'PostsController@show');
