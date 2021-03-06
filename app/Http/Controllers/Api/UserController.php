<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\User;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;
use App\Model\Token;

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
            $response=[
                "error"=>"0",
                "msg"=>"注册成功"
            ];
            return $response;
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
        if($user){
            $pwd=password_verify($pwd,$user->pwd);
            if($pwd){
                //生成token
                $token=Str::random(32);
                $token=sha1($token);
                $data=[
                    "token"=>$token,
                    "uid"=>$user->user_id
                ];
                Token::create($data);

                //调用登陆接口次数
                $data=$_SERVER['REQUEST_URI'];
                $keys="h:view_count:".$user->user_id;
                Redis::hincrby($keys,$data,1);
                $response=[
                    "error"=>"0",
                    "msg"=>"登陆成功",
                    "data"=>[
                        "token"=>$token,
                        "uid"=>$user->user_id
                    ]
                ];
            }else{
                $response=[
                    "error"=>"40005",
                    "msg"=>"密码错误"
                ];
            }
        }else{
            $response=[
                "error"=>"40006",
                "msg"=>"登陆失败,没有此账号"
            ];
        }
        return $response;
    }
    public function conter(Request $request){
//        $keys="sign_in";//签到
//        Redis::zincrby($keys,time(),"zhangsan");
//        Redis::incr($key);

        //个人中心
        $token=$request->get('token');
        $data=Token::where(["token"=>$token])->first();
        $response=[
            "error"=>"0",
            "id"=>$data->uid,
            "msg"=>"欢迎来到个人中心"
        ];

        return $response;
    }
}
