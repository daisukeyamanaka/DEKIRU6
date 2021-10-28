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

// ビデオチャット
Route::group(['middleware' => 'auth'], function(){

    Route::get('video_chat', 'VideoChatController@index');      // チャットページ
    Route::post('auth/video_chat', 'VideoChatController@auth'); // 認証ページ

});
