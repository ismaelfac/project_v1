<?php

use Illuminate\Auth\Access\AuthorizationException;

Route::get('/','DashboardController@index')->name('admin_dashboard');

Route::catch(function () {
    throw new AuthorizationException;
});