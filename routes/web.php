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

Route::group(['middleware' => 'auth:web'], function () {
    Route::get('/post', 'Users\PostController@index');
    Route::group(['prefix' => 'post', 'middleware' => 'can:post'], function () {
        Route::get('create', 'Users\PostController@create');
        Route::post('store', 'Users\PostController@store');
        Route::get('show/{id}', 'Users\PostController@show');
        Route::get('edit/{id}', 'Users\PostController@edit');
        Route::get('delete/{id}', 'Users\PostController@delete');
        Route::post('update/{id}', 'Users\PostController@update');
    });

});

Route::get('/login', 'Users\LoginController@index')->name('login');
Route::post('/login', 'Users\LoginController@login');
Route::get('/logout', 'Users\LoginController@logout');

Route::get('/register', 'Users\RegisterController@index');
Route::post('/register', 'Users\RegisterController@register');



include_once("admin.php");