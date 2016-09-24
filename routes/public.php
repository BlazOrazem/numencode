<?php

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Homepage
Route::get('/', 'HomeController@index');

// Pages
Route::get('page/{id}', 'PageController@index');
Route::get('tasks', 'TaskController@index');

Route::get('test-mail', 'TaskController@sendTestMail');