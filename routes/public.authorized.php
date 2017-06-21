<?php

/*
|--------------------------------------------------------------------------
| Public Authorized Routes
|--------------------------------------------------------------------------
*/

// Blog comment
Route::post('blog/comment/{blogItem}', 'BlogController@addComment')->name('blog.comment')->middleware('allowance:write_comments');
