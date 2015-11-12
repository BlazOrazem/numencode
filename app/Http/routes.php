<?php

// Homepage route
Route::resource('/', 'HomeController@index');

// Authentication routes
Route::get('auth/login',  ['as' => 'login', 'uses' => 'Auth\AuthController@getLogin']);
Route::post('auth/login', ['as' => 'login_action', 'uses' => 'Auth\AuthController@postLogin']);
Route::get('auth/logout', ['as' => 'logout', 'uses' => 'Auth\AuthController@getLogout']);

// Registration routes
Route::get('auth/register',  ['as' => 'register', 'uses' => 'Auth\AuthController@getRegister']);
Route::post('auth/register', ['as' => 'register_action', 'uses' => 'Auth\AuthController@postRegister']);
Route::get('auth/register/verify/{token}', 'Auth\AuthController@verifyEmail');

// Socialite authentication routes
Route::get('auth/social/{provider?}', ['as' => 'login_social', 'uses' => 'Auth\SocialAuthController@getLogin']);

// Password reset link request routes
Route::get('password/email',  ['as' => 'password_forget', 'uses' => 'Auth\PasswordController@getEmail']);
Route::post('password/email', ['as' => 'password_send', 'uses' => 'Auth\PasswordController@postEmail']);

// Password reset routes
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', ['as' => 'password_reset', 'uses' => 'Auth\PasswordController@postReset']);

// User profile routes
Route::get('profile',           ['as' => 'profile', 'uses' => 'ProfileController@index']);
Route::post('profile/update',   ['as' => 'profile_update', 'uses' => 'ProfileController@updateProfile']);
Route::post('profile/password', ['as' => 'password_update', 'uses' => 'ProfileController@updatePassword']);