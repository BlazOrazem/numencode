<?php

/*
|--------------------------------------------------------------------------
| Socialite Authentication Guest Routes
|--------------------------------------------------------------------------
*/

Route::get('socialite/{provider?}', 'LoginSocialiteController@login')->name('login.socialite');
