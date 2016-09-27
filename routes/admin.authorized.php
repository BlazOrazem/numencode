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
Route::resource('managers', 'ManagerController');

// Users
Route::resource('users', 'UserController');

// Tasks
Route::get('task/api', 'TaskController@api')->name('admin.tasks.api');
Route::resource('task', 'TaskController');

// Roles and Permissions
Route::get('roles', 'RoleController@index')->name('roles.index');
Route::get('roles/{role}/permissions', 'RoleController@assignPermissions')->name('roles.permissions');
