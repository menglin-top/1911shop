<?php

namespace App\Http\Controllers\Goods;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Goods;

class IndexController extends Controller
{
    public function cart($goods_id){
        $goods_info=Goods::where("goods_id",$goods_id)->first();
        return view("admin/goods/cart",compact("goods_info"));
    }
    public function goods($goods_id){
        $goods_info=Goods::where("goods_id",$goods_id)->first();
        return view("admin/goods/goods",compact("goods_info"));
    }
    public function checkout(){
        return view("admin/goods/checkout");
    }
}
