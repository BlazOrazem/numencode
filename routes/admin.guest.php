<?php

/*
|--------------------------------------------------------------------------
| Admin Guest Routes
|--------------------------------------------------------------------------
*/

// Authentication
Route::get('login', 'LoginController@getLogin')->name('admin.login');
Route::post('login', 'LoginController@postLogin')->name('admin.login.post');
