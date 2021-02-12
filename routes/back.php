<?php
use Illuminate\Support\Facades\Route;
 
//dashboardControllerはシングルアクション(__invoke)なのでアクション名はいらない
Route::get('/', 'DashboardController')->name('dashboard');

// except 管理画面ではshowだけ使用しない
// Route::resource CRUDルーティングを一度に行う
Route::resource('posts','PostController')->except('show');