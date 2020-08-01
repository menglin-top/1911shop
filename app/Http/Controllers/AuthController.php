<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function auth(){
        $id="6d28866c8aa66430e361";
        $redirect_uri="https://developer.github.com/apps/building-oauth-apps/authorizing-oauth-apps/#redirect-urls";
        $url="https://github.com/login/oauth/authorize?client_id=".$id."&redirect_uri=".$redirect_uri;
        $res=file_get_contents($url);
        echo $res;
    }
    public function auth2($code){
        $client_id="6d28866c8aa66430e361";
        $client_secret="5ea5245a8318c7f460a401afc8eaeb001c61b487";
        $url="https://github.com/login/oauth/access_token?client_id=".$client_id."&client_secret=".$client_secret."&code=".$code;

    }
}
