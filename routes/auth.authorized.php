<?php

/*
|--------------------------------------------------------------------------
| Authentication Authorized Routes
|--------------------------------------------------------------------------
*/

$loginController = config('login.throttle') ? 'LoginWithThrottleController' : 'LoginController';

// Logout
Route::get('logout', $loginController . '@logout')->name('logout');

// User profile
Route::get('profile', 'ProfileController@showProfileUpdateForm')->name('profile');
Route::post('profile/update', 'ProfileController@update')->name('profile.update');
