<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use App\Model\Token;

class indexController extends Controller
{
    //登陆
    public function login(){
        return view("admin/index/login");
    }
    public function do_login(){
        $username=request()->post("username");
        $email=request()->post("email");
        $pwd=request()->post("pwd");
        $url="http://www.api.com/index/login?username=".$username."&email=".$email."&pwd=".$pwd;
        $res=file_get_contents($url);
        echo $res;echo "<hr>";
        $res=json_decode($res,true);
        $token=$res["data"]["token"];
        if($res["errno"]==0){
            return redirect("http://www.lin.com/admin/user?token=".$token);
        }
    }
    //注册
    public function reg(){
        return view("admin/index/reg");
    }
    public function do_reg(){
        $username=request()->post("username");
        $email=request()->post("email");
        $pwd=request()->post("pwd");
        $url="http://www.api.com/index/reg?username=".$username."&email=".$email."&pwd=".$pwd;
        $res=file_get_contents($url);
        echo $res;
        $res=json_decode($res,true);
        if($res["error"]==0){
            return redirect("http://www.lin.com/admin/login");
        }
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

        $data=Token::where(["token"=>$token])->first();
        if(!$data){
            $response=[
                "error"=>"40005",
                "msg"=>"请输入正确得token"
            ];
            return $response;
        }
//        $url="http://www.api.com/index/user";
//        $res=file_get_contents($url);
//        echo $res;
        return view("admin/index/user");
    }
}
