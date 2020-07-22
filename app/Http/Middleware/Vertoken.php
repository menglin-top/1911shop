<?php

namespace App\Http\Middleware;

use Closure;
use App\Model\User;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Str;
use App\Model\Token;

class Vertoken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //token必填，否则出错
        $token=$request->get('token');
        if(empty($token)){
            $response=[
                "error"=>"40007",
                "msg"=>"请输入token"
            ];
            return response()->json($response);
        }

        //接口调用次数
        $key="black";//黑名单
        $key_cont="cont";
        $cont=Redis::incr($key_cont);
        if($cont>100){
            $response=[
                "error"=>"40008",
                "msg"=>"接口调用超过100次,请重新获取token"
            ];
            Redis::sadd($key,$token);
            return response()->json($response);
        }

//        token必须输入正确
        $data=Token::where(["token"=>$token])->first();
        if(!$data){
            $response=[
                "error"=>"40009",
                "msg"=>"请输入正确得token"
            ];
            return response()->json($response);
        }
        $request->attributes->add(["uid"=>$data->uid]);
        return $next($request);
    }
}
