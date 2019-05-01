<?php

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

Route::get('/','DashboardController@index')->name('admin_dashboard');

Route::put('admin/posts/{post}', function (Post $post, Request $request) {
    $post->update([
        'title' => $request->title
    ])->middleware('can:update,post');
    return 'Post Updated!';
});