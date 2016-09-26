<?php

/*
|--------------------------------------------------------------------------
| Admin Guest Routes
|--------------------------------------------------------------------------
*/

// Authentication
Route::get('login', 'Auth\AuthController@getLogin')->name('admin.login');
Route::post('login', 'Auth\AuthController@postLogin')->name('admin.login.action');
