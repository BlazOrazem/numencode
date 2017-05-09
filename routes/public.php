<?php

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Homepage
Route::get('/', 'HomeController@index')->name('en:home');
Route::get('sl/', 'HomeController@index')->name('sl:home');

// Pages
Route::get('page/{id}', 'PageController@index');
Route::get('sl/stran/{id}', 'PageController@index');
