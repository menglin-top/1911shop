<?php

namespace App\Http\Controllers\Goods;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Goods;

class IndexController extends Controller
{
    public function product_list(){
        return view("admin/goods/product_list");
    }
}
