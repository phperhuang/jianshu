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

//Route::group();

Route::get('/login', 'App\Http\Controllers\Users\LoginController@index');
Route::post('/login', 'App\Http\Controllers\Users\LoginController@login');
Route::get('/logout', 'App\Http\Controllers\Users\LoginController@logout');



include_once("admin.php");