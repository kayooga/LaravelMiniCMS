<?php
use Illuminate\Support\Facades\Route;
 
//ホーム画面の設定
Route::get('/', 'PostController@index')->name('home');
//Route::resource CRUDルーティングを一度に行う
//only フロントではindexとshowにだけアクセスする
Route::resource('posts', 'PostController')->only(['index','show']);