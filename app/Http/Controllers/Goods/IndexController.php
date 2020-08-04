<?php

namespace App\Http\Controllers\Goods;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Goods;

class IndexController extends Controller
{
    //购物车
    public function cart($goods_id){
        $goods_info=Goods::where("goods_id",$goods_id)->first();
        return view("admin/goods/cart",compact("goods_info"));
    }
    //商品详情
    public function goods($goods_id){
        $goods_info=Goods::where("goods_id",$goods_id)->first();
        return view("admin/goods/goods",compact("goods_info"));
    }
    public function do_cart($goods_id){
        $url="http://www.api.com/goods/cart?goods_id=".$goods_id;
        $res=file_get_contents($url);
        echo $res;
        if($res){
            return redirect("goods/cart/".$goods_id);
        }
    }
    //支付页面
    public function check($goods_id){
        $goods_info=Goods::where("goods_id",$goods_id)->first();
        return view("admin/goods/checkout",compact("goods_info"));
    }
}
