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
Route::get("/api/conter","Api\UserController@conter")->middleware("vertoken","incr");

//redis     练习
Route::get("/api/hash","TestController@hash");//存入redis
Route::get("/api/hash2","TestController@hash2");//获取redis值

//商品信息
Route::get("/goods/info","Api\GoodsController@info")->middleware("vertoken","incr");

//加密算法
Route::get("/api/encrypt","Api\OpensslController@encrypt");//对称加密
Route::any("/api/un_encrypt","Api\OpensslController@un_encrypt");//非对称加密
Route::get("/api/sign","Api\OpensslController@sign");//签名
Route::get("/api/open_sign","Api\OpensslController@open_sign");//签名
Route::get("/api/sign_encrypt","Api\OpensslController@sign_encrypt");//对称加密+签名

//支付宝支付
Route::any("/test/pay","Pay\PaymentController@testpay");//支付页面
Route::any("/pay","Pay\PaymentController@pay");//二维码支付

//github登陆
Route::get("/auth/login","AuthController@auth");//github登陆

//h5商城
Route::any("/admin/login","Admin\IndexController@login");//登陆
Route::any("/admin/do_login","Admin\IndexController@do_login");//登陆
Route::any("/admin/reg","Admin\IndexController@reg");//注册
Route::any("/admin/do_reg","Admin\IndexController@do_reg");//注册
Route::any("/admin/user","Admin\IndexController@user");//个人中心
Route::any("/goods/product_list","Goods\IndexController@product_list");//商品页