<?php


//use Illuminate\Routing\Route;

Route::group(['prefix' => 'admin'], function () {
    Route::get('login', 'Admin\LoginController@index');
    Route::post('login', 'Admin\LoginController@login');
});