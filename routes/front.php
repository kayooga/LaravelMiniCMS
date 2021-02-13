<?php
use Illuminate\Support\Facades\Route;
 
//ホーム画面の設定
Route::get('/', 'PostController@index')->name('home');
//Route::resource CRUDルーティングを一度に行う
//only フロントではindexとshowにだけアクセスする
Route::resource('posts', 'PostController')->only(['index','show']);

Route::get('posts/tag/{tagSlug}','PostController@index')
    ->where('tagSlug','[a-z]+')
    ->name('posts.index.tag');