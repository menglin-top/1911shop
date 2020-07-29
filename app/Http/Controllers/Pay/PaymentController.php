<?php

namespace App\Http\Controllers\Pay;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    //支付页面
    public function testpay(){
        return view("pay/payment");
    }
    //二维码支付
    public function pay(){
        $oid=request()->get("oid");

    }
}
