<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/post','PostController');

//summernoteのページの表示
Route::get('/summernote/create','SummernoteController@create')->name('summernote.create');

//summernoteの保存
Route::post('/summernote/store','SummernoteController@store')->name('summernote.store');

//summernoteの画像の保存
Route::post('/summernote/temp','SummernoteController@image')->name('summernote.image');

//デモで表示するページ
Route::get('/summernote/show','SummernoteController@show')->name('summernote.show');

//記事の削除
Route::delete('/summernote/delete/{id}','SummernoteController@delete')->name('summernote.delete');
