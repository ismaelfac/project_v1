<?php

use Illuminate\Auth\Access\AuthorizationException;


Route::catch(function () {
    throw new AuthorizationException;
});