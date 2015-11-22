<?php

// Homepage route
Route::resource('/', '\Cms\Controllers\HomeController@index');

// Admin routes
Route::resource('admin', '\Admin\Controllers\DashboardController@index');
