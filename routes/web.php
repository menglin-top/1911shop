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
Route::get("/token","TestController@token");//获取微信access_token    file_get_conetens
Route::get("/token2","TestController@token2");//获取微信access_token   curl
Route::get("/token3","TestController@token3");//获取微信access_token   第三方类库

Route::get("/api/test","TestController@test");//联通两个框架

//注册
Route::get("/api/reg","Api\UserController@reg");
Route::post("/api/reg_do","Api\UserController@reg_do");
//登陆
Route::get("/api/login","Api\UserController@login");
Route::post("/api/login_do","Api\UserController@login_do");
//用户中心
Route::get("/api/conter","Api\UserController@conter");

//redis     练习
Route::get("/api/hash","TestController@hash");//存入redis
Route::get("/api/hash2","TestController@hash2");//获取redis值

//商品信息
Route::get("/goods/info","Api\GoodsController@info");
