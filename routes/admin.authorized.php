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
Route::get('tasks/api', 'TaskController@api')->name('admin.tasks.api');
Route::resource('tasks', 'TaskController');

// Codelist
Route::resource('codelist', 'CodelistController');
Route::post('codelist_item/{group}', 'CodelistController@storeItem')->name('codelist.item.create');
Route::patch('codelist_item/{item}', 'CodelistController@updateItem')->name('codelist.item.update');
Route::delete('codelist_item/{item}', 'CodelistController@destroyItem')->name('codelist.item.destroy');
Route::get('codelist_item/{item}/edit', 'CodelistController@editItem')->name('codelist.item.edit');

// Roles and Permissions
Route::resource('roles', 'RoleController');
Route::resource('permissions', 'PermissionController');
Route::get('roles/{role}/permissions', 'RoleController@assignPermissions')->name('roles.permissions');
