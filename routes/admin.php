<?php

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;


Route::put('admin/posts/{post}', function (Post $post, Request $request) {
    $post->update([
        'title' => $request->title
    ])->middleware('can:update,post');
    return 'Post Updated!';
});

Route::group(['prefix' => 'admin'], function () {
    Route::get('parameters', function() { return view('admin.dashboardParameters');});
    Route::get('systems', function() { return view('admin.content_system');});
    Route::resource('roles', 'RoleController');
    Route::resource('permissions', 'PermissionController');
    Route::resource('users', 'UserController');
});