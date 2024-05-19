<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::namespace('App\Http\Controllers\Api')->group(function () {
    Route::post('auth/login', 'AuthController@login');

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('hotels', 'HotelsController@index');
        Route::post('hotels', 'HotelsController@store');
        Route::get('hotels/{id}', 'HotelsController@show');
        Route::put('hotels/{id}', 'HotelsController@update');
        Route::delete('hotels/{id}', 'HotelsController@delete');
    });
});
