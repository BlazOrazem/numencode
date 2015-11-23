<?php

// Homepage route
Route::resource('/', '\Cms\Http\HomeController@index');

// Admin routes
Route::resource('admin', '\Admin\Http\DashboardController@index');
