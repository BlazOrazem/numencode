<?php

/*
|--------------------------------------------------------------------------
| Admin Authorized Routes
|--------------------------------------------------------------------------
*/

// Admin dashboard
Route::get('/', 'DashboardController@index')->name('admin.dashboard');

// Authentication logout
Route::get('logout', 'Auth\AuthController@getLogout')->name('admin.logout');

// Managers
Route::resource('manager', 'ManagerController');

// Users
 Route::resource('user', 'UserController');

// Tasks
Route::get('task/api', 'TaskController@api')->name('admin.tasks.api');
Route::resource('task', 'TaskController');
