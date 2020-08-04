<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = "p_order";
    protected $primaryKey = "rec_id";
    public $timestamps = false;
    public $fillable=["goods_name","goods_sn","goods_id","goods_number","shop_price","cat_id"];

}
