<?php

use Illuminate\Auth\Access\AuthorizationException;
use App\Post;

Route::get('/','DashboardController@index')->name('admin_dashboard');

Route::put('admin/posts/{post}', function (Post $post) {
    return 'Post Updated!';
});