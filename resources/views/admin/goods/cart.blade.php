@extends("layouts.layout")
@section("content")

<!-- cart -->
<div class="cart section">
    <form action="{{url("goods/check/".$goods_info->goods_id)}}" method="post">
    <div class="container">
            <div class="pages-head">
                <h3>CART</h3>
            </div>
            <div class="content">
                <div class="cart-1" goods_id={{$goods_info->goods_id}}>
                    <div class="row">
                        <div class="col s5">
                            <h5>Image</h5>
                        </div>
                        <div class="col s7">
                            <img src="{{env('UPLOADS_URL')}}{{$goods_info->goods_img}}" alt="">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s5">
                            <h5>Name</h5>
                        </div>
                        <div class="col s7">
                            <h5><a href="">{{$goods_info->goods_name}}</a></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s5">
                            <h5>Quantity</h5>
                        </div>
                        <div class="col s7">
                            <input type="text" value="{{$goods_info->sale_num}}" id="goods_num">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s5">
                            <h5>Stock</h5>
                        </div>
                        <div class="col s7">
                            <h5 id="sorck">{{$goods_info->goods_number}}</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s5">
                            <h5>Price</h5>
                        </div>
                        <div class="col s7">
                            <h5 id="goods_price">{{$goods_info->shop_price}}</h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col s5">
                            <h5>Action</h5>
                        </div>
                        <div class="col s7">
                            <h5><i class="fa fa-trash"></i></h5>
                        </div>
                    </div>
                </div>

            </div>
            <div class="total">
                <div class="row">
                    <div class="col s7">
                        <h5>Fashion Men's</h5>
                    </div>
                    <div class="col s5">
                        <h5>${{$goods_info->shop_price}}</h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col s7">
                        <h6>Total</h6>
                    </div>
                    <div class="col s5">
                        <h6>${{$goods_info->total}}</h6>
                    </div>
                </div>
            </div>
            <button class="btn button-default" type="submit">Process to Checkout</button>
        </div>
    </form>
</div>
<!-- end cart -->
@endsection
<script src="/style/js/jquery.min.js"></script>
<script type="text/javascript">
    $(document).on('blur','#goods_num',function(){
        var goods_id=$('.cart-1').attr('goods_id');
        var goods_num=$('#goods_num').val();//购买数量
        var sorck=$('#sorck').text();//商品库存
        var goods_price=$('#goods_price').text();//商品单价
        if(goods_num==''){
            $('#goods_num').val(1);
        }else if(goods_num>parseInt(sorck)){
            alert('商品库存不足,请重新选择');
        }else if(goods_num<=0){
            alert('请输入正确的商品数量');
        }
        $.ajax({
            'url':'http://www.api.com/goods/product',
            'type':'post',
            'data':{goods_num:goods_num,goods_price:goods_price,goods_id:goods_id},
            success:function(res){
                if(res==1){
                    location.reload("http://www.lin.com/goods/cart?goods_id=".goods_id);
                }
            }
        })


    })
</script>



