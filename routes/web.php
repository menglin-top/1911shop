<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get("/token","TestController@token");
Route::get("/token2","TestController@token2");
Route::get("/token3","TestController@token3");

Route::get("/api/test","TestController@test");

