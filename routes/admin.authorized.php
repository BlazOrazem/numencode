<?php

/*
|--------------------------------------------------------------------------
| Admin Authorized Routes
|--------------------------------------------------------------------------
*/

// Admin dashboard
Route::get('/', 'DashboardController@index')->name('admin.dashboard');

// Authentication logout
Route::get('logout', 'Auth\LoginController@getLogout')->name('admin.logout');

// Users
Route::resource('pages', 'PageController');

// Managers
Route::post('managers', 'ManagerController@store')->name('managers.store')->middleware('permission:manage_managers');
Route::get('managers', 'ManagerController@index')->name('managers.index')->middleware('permission:view_managers');
Route::get('managers/create', 'ManagerController@create')->name('managers.create')->middleware('permission:manage_managers');
Route::get('managers/{manager}', 'ManagerController@show')->name('managers.show')->middleware('permission:view_managers');
Route::delete('managers/{manager}', 'ManagerController@destroy')->name('managers.destroy')->middleware('permission:manage_managers');
Route::match(['PUT', 'PATCH'], 'managers/{manager}', 'ManagerController@update')->name('managers.update')->middleware('permission:manage_managers');
Route::get('managers/{manager}/edit', 'ManagerController@edit')->name('managers.edit')->middleware('permission:manage_managers');

// Users
Route::resource('users', 'UserController');

// Menu Types
Route::resource('menus', 'MenuController');

// Plugins
Route::resource('plugins', 'PluginController');

// Codelist
Route::post('codelist/item/{group}', 'CodelistController@storeItem')->name('codelist.item.create');
Route::patch('codelist/item/{item}', 'CodelistController@updateItem')->name('codelist.item.update');
Route::delete('codelist/item/{item}', 'CodelistController@destroyItem')->name('codelist.item.destroy');
Route::get('codelist/item/{item}/edit', 'CodelistController@editItem')->name('codelist.item.edit');
Route::resource('codelist', 'CodelistController');

// Roles and Permissions
Route::post('roles/assign/{role}/{permission}', 'RoleController@assignPermission')->name('roles.assign.permissions');
Route::post('roles/manager/{manager}/{role}', 'RoleController@assignManagerRole')->name('roles.assign.manager');
Route::resource('roles', 'RoleController');
Route::resource('permissions', 'PermissionController');

// Tasks
Route::get('tasks/api', 'TaskController@api')->name('admin.tasks.api');
Route::resource('tasks', 'TaskController');

// Log Viewer
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->name('log.viewer');
