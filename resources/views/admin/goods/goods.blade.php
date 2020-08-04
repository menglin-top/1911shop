@extends("layouts.layout")
@section("content")
<!-- side nav right-->
<div class="side-nav-panel-right">
    <ul id="slide-out-right" class="side-nav side-nav-panel collapsible">
        <li class="profil">
            <img src="/style/img/profile.jpg" alt="">
            <h2>John Doe</h2>
        </li>
        <li><a href="setting.html"><i class="fa fa-cog"></i>Settings</a></li>
        <li><a href="about-us.html"><i class="fa fa-user"></i>About Us</a></li>
        <li><a href="contact.html"><i class="fa fa-envelope-o"></i>Contact Us</a></li>
        <li><a href="login.html"><i class="fa fa-sign-in"></i>Login</a></li>
        <li><a href="register.html"><i class="fa fa-user-plus"></i>Register</a></li>
    </ul>
</div>
<!-- end side nav right-->


<!-- shop single -->
<div class="pages section">
    <div class="container">
        <form action="{{url("/goods/cart/".$goods_info->goods_id)}}" method="post">
            <div class="shop-single">
                <img src="{{env("UPLOADS_URL")}}{{$goods_info->goods_img}}" alt="">
                <h5>{{$goods_info->goods_name}}</h5>
                <div class="price">${{$goods_info->shop_price}} <span>$28</span></div>
                <p>{{$goods_info->goods_desc}}</p>
                <button type="submit" class="btn button-default">ADD TO CART</button>
            </div>
        </form>
        <div class="review">
            <h5>1 reviews</h5>
            <div class="review-details">
                <div class="row">
                    <div class="col s3">
                        <img src="/style/img/user-comment.jpg" alt="" class="responsive-img">
                    </div>
                    <div class="col s9">
                        <div class="review-title">
                            <span><strong>John Doe</strong> | Juni 5, 2016 at 9:24 am | <a href="">Reply</a></span>
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Perferendis accusantium corrupti asperiores et praesentium dolore.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="review-form">
            <div class="review-head">
                <h5>Post Review in Below</h5>
                <p>Lorem ipsum dolor sit amet consectetur*</p>
            </div>
            <div class="row">
                <form class="col s12 form-details">
                    <div class="input-field">
                        <input type="text" required class="validate" placeholder="NAME">
                    </div>
                    <div class="input-field">
                        <input type="email" class="validate" placeholder="EMAIL" required>
                    </div>
                    <div class="input-field">
                        <input type="text" class="validate" placeholder="SUBJECT" required>
                    </div>
                    <div class="input-field">
                        <textarea name="textarea-message" id="textarea1" cols="30" rows="10" class="materialize-textarea" class="validate" placeholder="YOUR REVIEW"></textarea>
                    </div>
                    <div class="form-button">
                        <div class="btn button-default">POST REVIEW</div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- end shop single -->

<!-- loader -->
<div id="fakeLoader"></div>
<!-- end loader -->
@endsection