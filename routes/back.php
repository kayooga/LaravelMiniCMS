<?php
use Illuminate\Support\Facades\Route;
 
//dashboardControllerはシングルアクション(__invoke)なのでアクション名はいらない
Route::get('/', 'DashboardController')->name('dashboard');