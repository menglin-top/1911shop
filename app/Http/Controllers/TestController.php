<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redis;

class TestController extends Controller
{
    public function hash(){
        $data=[
            'name'=>"Joke",
            'email'=>'1501113246@qq.com',
            'like'=>'music'
        ];
        $key="tom";
        Redis::hmset($key,$data);
    }
    public function hash2(){
        $key="tom";
        $res=Redis::hgetall($key);
        return $res;
    }
    //联通两个项目
    public function test(){
        $url="http://www.api.com/api/info";
        $response=file_get_contents($url);
        var_dump($response);
    }
    //获取access_token
    public function token(){
        $appid="wx8ca8cb8ce820d272";
        $secret="97698e5e537e0dabf5e331a0d523d6d2";
        $url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$secret;
        $content=file_get_contents($url);
        echo $content;
    }
    public function token2(){
        $appid="wx8ca8cb8ce820d272";
        $secret="97698e5e537e0dabf5e331a0d523d6d2";
        $url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$secret;
        //curl初始化
        $ch=curl_init();
        //设置url相应选项
        curl_setopt($ch, CURLOPT_URL, $url);//向那个url地址上面发送
        curl_setopt($ch,CURLOPT_HEADER,0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($ch);//执行
        curl_close($ch);    //关闭
        echo $output;
    }
    public function token3(){
        $appid="wx8ca8cb8ce820d272";
        $secret="97698e5e537e0dabf5e331a0d523d6d2";
        $url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".$appid."&secret=".$secret;
        //实例化客户端
        $client = new Client();
        //返回状态码
        // echo $res->getStatusCode();
        $res = $client->request('GET', $url)->getBody();
        echo $res;
    }
}
