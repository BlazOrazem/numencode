<?php

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Homepage
Route::get('/', 'HomeController@index')->name('home');
Route::get('sl/', 'HomeController@index');

// Pages
Route::get('page/{id}', 'PageController@index');
Route::get('sl/stran/{id}', 'PageController@index');

Route::get('tasks', 'TaskController@index');
