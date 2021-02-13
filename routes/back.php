<?php
use Illuminate\Support\Facades\Route;
 
//dashboardControllerはシングルアクション(__invoke)なのでアクション名はいらない
Route::get('/', 'DashboardController')->name('dashboard');

// except 管理画面ではshowだけ使用しない
// Route::resource CRUDルーティングを一度に行う
Route::resource('posts','PostController')->except('show');
Route::resource('tags','TagController')->except('show');

//管理者のみユーザーの管理をする
//middlewareにcan:adminを指定して、制限したいページを囲む
Route::group(['middleware' => 'can:admin'],function () {
    Route::resource('users', 'UserController')->except('show');
});