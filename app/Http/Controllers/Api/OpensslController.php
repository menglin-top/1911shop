<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OpensslController extends Controller
{
    //对称加密
    public function encrypt(){
        $info="八百里告急";
        $key="1911api";
        $method="AES-256-CBC";
        $iv="aaaabbbbccccdddd";
        $enc_data=openssl_encrypt($info,$method,$key,OPENSSL_RAW_DATA,$iv);
        $enc_data=base64_encode($enc_data);
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
    //非对称加密
    public function un_encrypt(){
        $data="不愧是我";
        $pub_key_count=file_get_contents(storage_path("keys/www.pub.key"));//获取公钥内容
        $pub_key=openssl_get_publickey($pub_key_count);//获取公钥
        openssl_public_encrypt($data,$enc_data,$pub_key);//公钥加密
        echo "公钥加密后:".$enc_data;echo "<hr>";

        $url="http://www.api.com/api/un_decrypt";

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
        $res=curl_close($ch);
        echo "<hr>";

        $pri_key_count=file_get_contents(storage_path("keys/api.priv.key"));//获取私钥内容
        $pri_key=openssl_get_privatekey($pri_key_count);//获取私钥
        openssl_private_decrypt($res,$dec_data2,$pri_key);//私钥解密
        echo $dec_data2;echo "<hr>";
    }
    //签名
    public function sign(){
        $key="1911api";
        $data="hualihushao";
        $sign=md5($key.$data);
        $url='http://www.api.com/api/sign?data='.$data . '&sign='.$sign;
        $res=file_get_contents($url);
        echo $res;
    }
}
