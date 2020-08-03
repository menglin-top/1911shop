<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function auth(){
        $code=$_GET["code"];
        $this->auth2($code);//获取access_token
        
    }
    //获取
    public function auth2($code){
        $client_id="6d28866c8aa66430e361";
        $client_secret="5ea5245a8318c7f460a401afc8eaeb001c61b487";
        $url="https://github.com/login/oauth/access_token";

        $data=[
            "client_id"=>$client_id,
            "client_secret"=>$client_secret,
            "code"=>$code,
        ];
        // 1 实例化
        $ch = curl_init();
        // 2 配置参数
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_POST,1);        // 使用post 方式
        curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);   // 通过变量接收响应

        // 3 开启会话（发送请求）
        $response = curl_exec($ch);
        echo $response;
        // 4 检测错误
        $errno = curl_errno($ch);       //错误码
        $errmsg = curl_error($ch);
        if($errno)
        {
            echo '错误码： '.$errno;echo '</br>';
            var_dump($errmsg);
            die;
        }
        $res=curl_close($ch);
        echo "<hr>";
        $top=strpos($response,"=");
        $top=$top+1;
        $foot=strpos($response,"&");
        $token=substr($response,$top,$foot-$top);
        echo $token;
        $this->user($token);
    }
    //获取用户信息
    public function user($token){
      //  $url="https://api.github.com/user?access_token=".$token;
        $url='https://api.github.com/user';
        $ch=curl_init();
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_HTTPHEADER,array('Authorization: token'.$token));
        $response=curl_exec($ch);
        if(curl_errno($ch)>0){
            echo curl_errno($ch);
            echo curl_error($ch);
            die;
        }
        curl_close($ch);
        var_dump($response);die;
//        $res=file_get_contents($url);
//        return $res;
    }
}
