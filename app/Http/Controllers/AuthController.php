<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function auth(){
        $id="6d28866c8aa66430e361";
        $url="https://github.com/login/oauth/authorize?id=".$id;
        $res=file_get_contents($url);
        echo $res;
    }
}
