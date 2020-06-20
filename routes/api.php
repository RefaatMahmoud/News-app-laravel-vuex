<?php

use Illuminate\Support\Facades\Route;

#user login
Route::prefix('auth')->group(
    function () {
        Route::post('login', 'AuthController@login');
    }
);
Route::group(
    ['middleware' => 'auth:api'],
    function () {
        Route::get('logout', 'AuthController@logout');
        Route::apiResource('news', 'NewsController');
    }
);

