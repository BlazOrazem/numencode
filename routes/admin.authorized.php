<?php

/*
|--------------------------------------------------------------------------
| Admin Authorized Routes
|--------------------------------------------------------------------------
*/

use Numencode\Utils\Imageable;

// Admin dashboard
Route::get('/', 'DashboardController@index')->name('admin.dashboard');
Route::get('/elements', 'DashboardController@elements')->name('admin.elements');
Route::post('/language', 'DashboardController@language')->name('admin.language');

// General ajax requests
Route::post('save-image', function () {
    Imageable::setFileName(basename(request()->image_path));

    if (!Imageable::createFromData(
        request()->image_data,
        basename(request()->image_path),
        request()->crop_path,
        request()->image_width,
        request()->image_height,
        true
    )) {
        return 'error';
    }

    return 'success';
})->name('admin.save.image');

// Authentication logout
Route::get('logout', 'Auth\LoginController@getLogout')->name('admin.logout');

// Always displayed contents
Route::post('contents', 'ContentController@store')->name('contents.store');
Route::get('contents', 'ContentController@index')->name('contents.index');
Route::get('contents/create/{page?}', 'ContentController@create')->name('contents.create');
Route::get('contents/{content}/edit', 'ContentController@edit')->name('contents.edit');
Route::match(['PUT', 'PATCH'], 'contents/{content}', 'ContentController@update')->name('contents.update');
Route::delete('contents/{content}', 'ContentController@destroy')->name('contents.destroy');

// Pages
Route::post('pages/active/{page}', 'PageController@active')->name('pages.active');
Route::post('pages', 'PageController@store')->name('pages.store');
Route::get('pages', 'PageController@index')->name('pages.index');
Route::get('pages/create-menu/{menu?}', 'PageController@createForMenu')->name('pages.create.menu');
Route::get('pages/create-page/{page?}', 'PageController@createForPage')->name('pages.create.page');
Route::get('pages/{page}/edit', 'PageController@edit')->name('pages.edit');
Route::match(['PUT', 'PATCH'], 'pages/{page}', 'PageController@update')->name('pages.update');
Route::delete('pages/{page}', 'PageController@destroy')->name('pages.destroy');

// Managers
Route::post('managers/tasks', 'ManagerController@saveTasks')->name('managers.tasks.save');
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
Route::post('users', 'UserController@store')->name('users.store')->middleware('permission:manage_users');
Route::get('users', 'UserController@index')->name('users.index')->middleware('permission:view_users');
Route::get('users/create', 'UserController@create')->name('users.create')->middleware('permission:manage_users');
Route::get('users/{user}', 'UserController@show')->name('users.show')->middleware('permission:view_users');
Route::get('users/{user}/edit', 'UserController@edit')->name('users.edit')->middleware('permission:manage_users');
Route::match(['PUT', 'PATCH'], 'users/{user}', 'UserController@update')->name('users.update')->middleware('permission:manage_users');
Route::delete('users/{user}', 'UserController@destroy')->name('users.destroy')->middleware('permission:manage_users');

// Menu Types
Route::post('menus', 'MenuController@store')->name('menus.store')->middleware('permission:manage_menus');
Route::get('menus', 'MenuController@index')->name('menus.index')->middleware('permission:manage_menus');
Route::get('menus/create', 'MenuController@create')->name('menus.create')->middleware('permission:manage_menus');
Route::get('menus/{menu}', 'MenuController@show')->name('menus.show')->middleware('permission:manage_menus');
Route::get('menus/{menu}/edit', 'MenuController@edit')->name('menus.edit')->middleware('permission:manage_menus');
Route::match(['PUT', 'PATCH'], 'menus/{menu}', 'MenuController@update')->name('menus.update')->middleware('permission:manage_menus');
Route::delete('menus/{menu}', 'MenuController@destroy')->name('menus.destroy')->middleware('permission:manage_menus');

// Plugins
Route::post('plugins/api', 'PluginController@api')->name('plugins.api');
Route::post('plugins', 'PluginController@store')->name('plugins.store')->middleware('permission:manage_plugins');
Route::get('plugins/render', 'PluginController@testRender');
Route::get('plugins', 'PluginController@index')->name('plugins.index')->middleware('permission:view_plugins');
Route::get('plugins/create', 'PluginController@create')->name('plugins.create')->middleware('permission:manage_plugins');
Route::get('plugins/{plugin}', 'PluginController@show')->name('plugins.show')->middleware('permission:view_plugins');
Route::get('plugins/{plugin}/edit', 'PluginController@edit')->name('plugins.edit')->middleware('permission:manage_plugins');
Route::match(['PUT', 'PATCH'], 'plugins/{plugin}', 'PluginController@update')->name('plugins.update')->middleware('permission:manage_plugins');
Route::delete('plugins/{plugin}', 'PluginController@destroy')->name('plugins.destroy')->middleware('permission:manage_plugins');

// Codelist
Route::post('codelist/item/{codelistGroup}', 'CodelistController@storeItem')->name('codelist.item.create')->middleware('permission:manage_codelist');
Route::get('codelist/item/{codelistItem}/edit', 'CodelistController@editItem')->name('codelist.item.edit')->middleware('permission:manage_codelist');
Route::match(['PUT', 'PATCH'], 'codelist/item/{codelistItem}', 'CodelistController@updateItem')->name('codelist.item.update')->middleware('permission:manage_codelist');
Route::delete('codelist/item/{codelistItem}', 'CodelistController@destroyItem')->name('codelist.item.destroy')->middleware('permission:manage_codelist');
Route::post('codelist', 'CodelistController@store')->name('codelist.store')->middleware('permission:manage_codelist');
Route::get('codelist', 'CodelistController@index')->name('codelist.index')->middleware('permission:view_codelist');
Route::get('codelist/create', 'CodelistController@create')->name('codelist.create')->middleware('permission:manage_codelist');
Route::get('codelist/{codelistGroup}/edit', 'CodelistController@edit')->name('codelist.edit')->middleware('permission:manage_codelist');
Route::match(['PUT', 'PATCH'], 'codelist/{codelistGroup}', 'CodelistController@update')->name('codelist.update')->middleware('permission:manage_codelist');
Route::delete('codelist/{codelistGroup}', 'CodelistController@destroy')->name('codelist.destroy')->middleware('permission:manage_codelist');

// Dictionary
Route::post('dictionary', 'DictionaryController@store')->name('dictionary.store');
Route::get('dictionary', 'DictionaryController@index')->name('dictionary.index');
Route::match(['PUT', 'PATCH'], 'dictionary', 'DictionaryController@update')->name('dictionary.update');
Route::delete('dictionary/{dictionary}', 'DictionaryController@destroy')->name('dictionary.destroy');

// Languages
Route::post('languages', 'LanguageController@store')->name('languages.store')->middleware('permission:manage_languages');
Route::get('languages', 'LanguageController@index')->name('languages.index')->middleware('permission:manage_languages');
Route::match(['PUT', 'PATCH'], 'languages/{language}', 'LanguageController@update')->name('languages.update')->middleware('permission:manage_languages');
Route::delete('languages/{language}', 'LanguageController@destroy')->name('languages.destroy')->middleware('permission:manage_languages');

// Roles and Permissions
Route::post('roles/assign/{role}/{permission}', 'RoleController@assignPermission')->name('roles.assign.permissions')->middleware('permission:manage_roles|assign_permissions|manage_permissions');
Route::post('roles/manager/{manager}/{role}', 'RoleController@assignManagerRole')->name('roles.assign.manager')->middleware('permission:manage_roles');
Route::post('roles/user/{user}/{role}', 'RoleController@assignUserRole')->name('roles.assign.user')->middleware('permission:manage_roles');
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

// Log Viewer
Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index')->name('log.viewer');

// Tasks Plugin
Route::post('tasks/complete/{task}', 'TaskController@complete')->name('tasks.complete');
Route::resource('tasks', 'TaskController');

// Blog Plugin
Route::post('blog/item/comment/{comment}', 'BlogController@publishComment')->name('blog.comment.publish')->middleware('permission:manage_blog');
Route::match(['PUT', 'PATCH'], 'blog/item/comment', 'BlogController@updateComment')->name('blog.comment.update')->middleware('permission:manage_blog');
Route::delete('blog/item/comment/{comment}', 'BlogController@destroyComment')->name('blog.comment.destroy')->middleware('permission:manage_blog');
Route::post('blog/item', 'BlogController@storeItem')->name('blog.item.store')->middleware('permission:manage_blog');
Route::get('blog/item/create/{blogCategory?}', 'BlogController@createItem')->name('blog.item.create')->middleware('permission:manage_blog');
Route::get('blog/item/{blogItem}/edit', 'BlogController@editItem')->name('blog.item.edit')->middleware('permission:manage_blog');
Route::get('blog/item/{blogItem}/comments', 'BlogController@comments')->name('blog.item.comments')->middleware('permission:manage_blog');
Route::match(['PUT', 'PATCH'], 'blog/item/{blogItem}', 'BlogController@updateItem')->name('blog.item.update')->middleware('permission:manage_blog');
Route::delete('blog/item/{blogItem}', 'BlogController@destroyItem')->name('blog.item.destroy')->middleware('permission:manage_blog');
Route::post('blog', 'BlogController@store')->name('blog.store')->middleware('permission:manage_blog');
Route::get('blog', 'BlogController@index')->name('blog.index')->middleware('permission:manage_blog');
Route::get('blog/create', 'BlogController@create')->name('blog.create')->middleware('permission:manage_blog');
Route::get('blog/{blogCategory}/edit', 'BlogController@edit')->name('blog.edit')->middleware('permission:manage_blog');
Route::get('blog/{blogCategory}/items', 'BlogController@items')->name('blog.items')->middleware('permission:manage_blog');
Route::match(['PUT', 'PATCH'], 'blog/{blogCategory}', 'BlogController@update')->name('blog.update')->middleware('permission:manage_blog');
Route::delete('blog/{blogCategory}', 'BlogController@destroy')->name('blog.destroy')->middleware('permission:manage_blog');

// Promotion Plugin
Route::post('promotion/item', 'PromotionController@storeItem')->name('promotion.item.store')->middleware('permission:manage_promotions');
Route::get('promotion/item/create/{promotionCategory?}', 'PromotionController@createItem')->name('promotion.item.create')->middleware('permission:manage_promotions');
Route::get('promotion/item/{promotionItem}/edit', 'PromotionController@editItem')->name('promotion.item.edit')->middleware('permission:manage_promotions');
Route::match(['PUT', 'PATCH'], 'promotion/item/{promotionItem}', 'PromotionController@updateItem')->name('promotion.item.update')->middleware('permission:manage_promotions');
Route::delete('promotion/item/{promotionItem}', 'PromotionController@destroyItem')->name('promotion.item.destroy')->middleware('permission:manage_promotions');
Route::post('promotion', 'PromotionController@store')->name('promotion.store')->middleware('permission:manage_promotions');
Route::get('promotion', 'PromotionController@index')->name('promotion.index')->middleware('permission:manage_promotions');
Route::get('promotion/create', 'PromotionController@create')->name('promotion.create')->middleware('permission:manage_promotions');
Route::get('promotion/{promotionCategory}/edit', 'PromotionController@edit')->name('promotion.edit')->middleware('permission:manage_promotions');
Route::get('promotion/{promotionCategory}/items', 'PromotionController@items')->name('promotion.items')->middleware('permission:manage_promotions');
Route::match(['PUT', 'PATCH'], 'promotion/{promotionCategory}', 'PromotionController@update')->name('promotion.update')->middleware('permission:manage_promotions');
Route::delete('promotion/{promotionCategory}', 'PromotionController@destroy')->name('promotion.destroy')->middleware('permission:manage_promotions');
