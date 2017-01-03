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
Route::get('managers/profile', 'ManagerController@profile')->name('managers.profile');
Route::match(['PUT', 'PATCH'], 'managers/profile', 'ManagerController@updateProfile')->name('managers.profile.update');
Route::get('managers/{manager}', 'ManagerController@show')->name('managers.show')->middleware('permission:view_managers');
Route::get('managers/{manager}/edit', 'ManagerController@edit')->name('managers.edit')->middleware('permission:manage_managers');
Route::match(['PUT', 'PATCH'], 'managers/{manager}', 'ManagerController@update')->name('managers.update')->middleware('permission:manage_managers');
Route::delete('managers/{manager}', 'ManagerController@destroy')->name('managers.destroy')->middleware('permission:manage_managers');

// Users
Route::resource('users', 'UserController');

// Menu Types
Route::post('menus', 'MenuController@store')->name('menus.store')->middleware('permission:manage_menus');
Route::get('menus', 'MenuController@index')->name('menus.index')->middleware('permission:manage_menus');
Route::get('menus/create', 'MenuController@create')->name('menus.create')->middleware('permission:manage_menus');
Route::get('menus/{menu}', 'MenuController@show')->name('menus.show')->middleware('permission:manage_menus');
Route::get('menus/{menu}/edit', 'MenuController@edit')->name('menus.edit')->middleware('permission:manage_menus');
Route::match(['PUT', 'PATCH'], 'menus/{menu}', 'MenuController@update')->name('menus.update')->middleware('permission:manage_menus');
Route::delete('menus/{menu}', 'MenuController@destroy')->name('menus.destroy')->middleware('permission:manage_menus');

// Plugins
Route::post('plugins', 'PluginController@store')->name('plugins.store')->middleware('permission:manage_plugins');
Route::get('plugins', 'PluginController@index')->name('plugins.index')->middleware('permission:view_plugins');
Route::get('plugins/create', 'PluginController@create')->name('plugins.create')->middleware('permission:manage_plugins');
Route::get('plugins/{plugin}', 'PluginController@show')->name('plugins.show')->middleware('permission:view_plugins');
Route::get('plugins/{plugin}/edit', 'PluginController@edit')->name('plugins.edit')->middleware('permission:manage_plugins');
Route::match(['PUT', 'PATCH'], 'plugins/{plugin}', 'PluginController@update')->name('plugins.update')->middleware('permission:manage_plugins');
Route::delete('plugins/{plugin}', 'PluginController@destroy')->name('plugins.destroy')->middleware('permission:manage_plugins');

// Codelist
Route::post('codelist/item/{group}', 'CodelistController@storeItem')->name('codelist.item.create')->middleware('permission:manage_codelist');
Route::get('codelist/item/{item}/edit', 'CodelistController@editItem')->name('codelist.item.edit')->middleware('permission:manage_codelist');
Route::match(['PUT', 'PATCH'], 'codelist/item/{item}', 'CodelistController@updateItem')->name('codelist.item.update')->middleware('permission:manage_codelist');
Route::delete('codelist/item/{item}', 'CodelistController@destroyItem')->name('codelist.item.destroy')->middleware('permission:manage_codelist');
Route::post('codelist', 'CodelistController@store')->name('codelist.store')->middleware('permission:manage_codelist');
Route::get('codelist', 'CodelistController@index')->name('codelist.index')->middleware('permission:view_codelist');
Route::get('codelist/create', 'CodelistController@create')->name('codelist.create')->middleware('permission:manage_codelist');
Route::get('codelist/{codelist}', 'CodelistController@show')->name('codelist.show')->middleware('permission:view_codelist');
Route::get('codelist/{codelist}/edit', 'CodelistController@edit')->name('codelist.edit')->middleware('permission:manage_codelist');
Route::match(['PUT', 'PATCH'], 'codelist/{codelist}', 'CodelistController@update')->name('codelist.update')->middleware('permission:manage_codelist');
Route::delete('codelist/{codelist}', 'CodelistController@destroy')->name('codelist.destroy')->middleware('permission:manage_codelist');

// Roles and Permissions
Route::post('roles/assign/{role}/{permission}', 'RoleController@assignPermission')->name('roles.assign.permissions')->middleware('permission:manage_roles|assign_permissions|manage_permissions');
Route::post('roles/manager/{manager}/{role}', 'RoleController@assignManagerRole')->name('roles.assign.manager')->middleware('permission:manage_roles');
Route::post('roles', 'RoleController@store')->name('roles.store')->middleware('permission:manage_roles');
Route::get('roles', 'RoleController@index')->name('roles.index')->middleware('permission:view_roles|manage_roles');
Route::get('roles/create', 'RoleController@create')->name('roles.create')->middleware('permission:manage_roles');
Route::get('roles/{role}', 'RoleController@show')->name('roles.show')->middleware('permission:manage_roles');
Route::get('roles/{role}/edit', 'RoleController@edit')->name('roles.edit')->middleware('permission:manage_roles');
Route::get('roles/{role}/show', 'RoleController@show')->name('roles.show')->middleware('permission:view_roles');
Route::match(['PUT', 'PATCH'], 'roles/{role}', 'RoleController@update')->name('roles.update')->middleware('permission:manage_roles');
Route::delete('roles/{role}', 'RoleController@destroy')->name('roles.destroy')->middleware('permission:manage_roles');
Route::post('permissions', 'PermissionController@store')->name('permissions.store')->middleware('permission:manage_permissions');
Route::get('permissions', 'PermissionController@index')->name('permissions.index')->middleware('permission:manage_permissions');
Route::get('permissions/create', 'PermissionController@create')->name('permissions.create')->middleware('permission:manage_permissions');
Route::get('permissions/{permission}', 'PermissionController@show')->name('permissions.show')->middleware('permission:manage_permissions');
Route::get('permissions/{permission}/edit', 'PermissionController@edit')->name('permissions.edit')->middleware('permission:manage_permissions');
Route::match(['PUT', 'PATCH'], 'permissions/{permission}', 'PermissionController@update')->name('permissions.update')->middleware('permission:manage_permissions');
Route::delete('permissions/{permission}', 'PermissionController@destroy')->name('permissions.destroy')->middleware('permission:manage_permissions');

// Tasks
Route::get('tasks/api', 'TaskController@api')->name('admin.tasks.api');
Route::resource('tasks', 'TaskController');

// Log Viewer
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->name('log.viewer');
