<?php

use Illuminate\Http\Request;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Sign up
Route::post('/signup','UserController@signUp')->middleware('guest');

// Sign in
Route::post('/signin','UserController@signIn')->middleware('guest');

// Get UUID of logged in user
Route::post('/getUUID','UserController@getUUID');

// Add a friend
Route::post('/add','UserController@addUser');