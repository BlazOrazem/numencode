<?php

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

// Email verification
Route::get('register/verify/{token}', 'RegisterController@verifyEmail')->name('register.verify');