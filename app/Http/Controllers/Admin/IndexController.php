<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class indexController extends Controller
{
    //登陆
    public function login(){
        return view("admin/index/login");
    }
    //注册
    public function reg(){
        return view("admin/index/reg");
    }
    //用户中心
    public function user(){
        $token=request()->get("token");
        if(empty($token)){
            $response=[
                "error"=>"40004",
                "msg"=>"请输入token",
            ];
            return $response;
        }
        return view("admin/index/user");
    }
}
