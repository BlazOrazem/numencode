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

// Menu Types
Route::resource('menus', 'MenuController');

// Codelist
Route::post('codelist/item/{group}', 'CodelistController@storeItem')->name('codelist.item.create');
Route::patch('codelist/item/{item}', 'CodelistController@updateItem')->name('codelist.item.update');
Route::delete('codelist/item/{item}', 'CodelistController@destroyItem')->name('codelist.item.destroy');
Route::get('codelist/item/{item}/edit', 'CodelistController@editItem')->name('codelist.item.edit');
Route::resource('codelist', 'CodelistController');

// Roles and Permissions
Route::post('roles/assign/{role}/{permission}', 'RoleController@assignPermission')->name('roles.assign');
Route::resource('roles', 'RoleController');
Route::resource('permissions', 'PermissionController');

// Tasks
Route::get('tasks/api', 'TaskController@api')->name('admin.tasks.api');
Route::resource('tasks', 'TaskController');
