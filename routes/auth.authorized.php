<?php

/*
|--------------------------------------------------------------------------
| Authentication Authorized Routes
|--------------------------------------------------------------------------
*/

$loginController = config('login.throttle') ? 'LoginWithThrottleController' : 'LoginController';

// Logout
Route::get('logout', $loginController . '@logout')->name('logout');

// User profile TODO
Route::get('profile', 'ProfileController@index')->name('profile');
Route::post('profile/update', 'ProfileController@updateProfile')->name('profile_update');