<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OpensslController extends Controller
{
    public function encrypt(){
        $info="八百里告急";
        $key="1911api";
        $method="AES-256-CBC";
        $iv="aaaabbbbccccdddd";
        $enc_data=openssl_encrypt($info,$method,$key,OPENSSL_RAW_DATA,$iv);
        echo $enc_data;
        echo "<hr>";
        $url="http://www.api.com/api/decrypt";

        // 1 实例化
        $ch = curl_init();
        // 2 配置参数
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_POST,1);        // 使用post 方式
        curl_setopt($ch,CURLOPT_POSTFIELDS,$enc_data);
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
        curl_close($ch);
        echo "<hr>";
    }
}
