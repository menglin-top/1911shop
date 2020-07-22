<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redis;

class Allsum
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
        $url=$_SERVER["REQUEST_URI"];
        $data=strpos($url,"?");
        if($data){
            $url=substr($url,0,$data);
        }
        $key="sum";
        Redis::zincrby($key,1,$url);
        return $next($request);
    }
}
