<?php

use App\Post;
use Illuminate\Http\Request;

Route::get('/','DashboardController@index')->name('admin_dashboard');

Route::put('admin/posts/{post}', function (Post $post, Request $request) {
    $post->update([
        'title' => $request->title
    ]);
    return 'Post Updated!';
});