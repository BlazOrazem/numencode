<?php

/*
|--------------------------------------------------------------------------
| Authentication Guest Routes
|--------------------------------------------------------------------------
*/

$loginController = config('login.throttle') ? 'LoginWithThrottleController' : 'LoginController';

// Login
Route::get('login', $loginController . '@showLoginForm')->name('login');
Route::post('login', $loginController . '@login')->name('login.post');

// Socialite Login
//Route::get('social/{provider?}', 'Auth\SocialAuthController@login')->name('login.social');

// Registration
Route::get('register', 'RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'RegisterController@register')->name('register.post');

// Password reset
Route::get('password/email', 'ForgotPasswordController@showLinkRequestForm')->name('password.forget');
Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')->name('password.send');
Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')->name('password');
Route::post('password/reset', 'ResetPasswordController@reset')->name('password.reset');
