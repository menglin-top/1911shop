<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\User;
use Illuminate\Support\Facades\Redis;

class UserController extends Controller
{
    //注册
    public function reg(){
        return view("user.reg");
    }
    public function reg_do(){
        $data=request()->input();
        if(empty($data["name"])){
           $response=[
               "error"=>"40001",
               "msg"=>"用户名不能为空"
           ];
            return $response;
        }
        if(empty($data["email"])){
            $response=[
                "error"=>"40002",
                "msg"=>"邮箱不能为空"
            ];
            return $response;
        }
        if(empty($data["pwd"])){
            $response=[
                "error"=>"40003",
                "msg"=>"密码不能为空"
            ];
            return $response;
        }
        if($data["pwd"]!=$data["pwd1"]){
            $response=[
                "error"=>"40004",
                "msg"=>"密码不一致"
            ];
            return $response;
        }
        $data["pwd"]=password_hash($data["pwd"],PASSWORD_DEFAULT);
        $res=User::create($data);
        if($res){
            return redirect("api/login");
        }
    }
    //登陆
    public function login(){
        return view("user.login");
    }
    public function login_do(){
        $name=request()->input("name");
        $pwd=request()->input("pwd");
        $user=User::where(["name"=>$name])->first();
        $res=password_verify($pwd,$user->pwd);
        if($res){
            $token=time();
            $token=sha1($token);
            Redis::set("name",$token);
            echo $token;die;
            return redirect("api/conter");
        }else{
            return redirect("api/login");
        }
    }
    public function conter(){
        echo "用户中心";
    }
}
