@extends("front.layout.master")

@section('title','Đặt hàng')

@section('body')
<!-- Breadcrumb Section Begin -->
<div class="breacrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text product-more">
                    <a href=""><i class="fa fa-home"></i> Trang chủ</a>
                    <a href="./cart">Giỏ hàng</a>
                    <span>Đặt hàng</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section Begin -->

<!-- Shopping Cart Section Begin -->
<section class="checkout-section spad">
    <div class="container">
        <form action="order" method="post" class="checkout-form">
            @csrf
            <div class="row">
                <div class="col-lg-6">
                    <h4>Thông tin giao hàng</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="fir">Họ tên <span>*</span></label>
                            <input type="text" id="" name="name" value="{{$user->name != null ? $user->name:''}}" placeholder="Nguyen Van A" required>
                        </div>
                        <div class="col-lg-6">
                            <label for="email">Email <span>*</span></label>
                            <input type="text" id="email" value="{{$user->email != null ? $user->email:''}}"  name="email" placeholder="example@gmail.com" required>
                        </div>
                        <div class="col-lg-6">
                            <label for="phone">Số điện thoại <span>*</span></label>
                            <input type="text" id="phone" name="phone" value="{{$user->phone != null ? $user->phone:''}}"  placeholder="0987654321" required>
                        </div>
                        <div class="col-lg-12">
                            <label for="street">Địa chỉ <span>*</span></label>
                            <input type="text" name="address" value="{{$user->address != null ? $user->address:''}}"  placeholder="4,Nguyen Tri Thanh Street" required>
                        </div>
                        <div class="col-lg-12">
                            <label for="town">Thành phố<span>*</span></label>
                            <input type="text" id="town" name="city" value="{{$user->city != null ? $user->city:''}}"  placeholder="Ha Noi" required>
                        </div>
                        <div class="col-lg-12">
                            <label for="cun">Quốc gia<span>*</span></label>
                            <input type="text" id="cun" name="country" value="{{$user->country != null ? $user->country:''}}"  placeholder="Viet Nam" required>
                        </div>

                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="place-order">
                        <h4>Sản phẩm bạn muốn đặt hàng</h4>
                        <div class="order-total">
                            <ul class="order-table">
                                <li>Sản phẩm <span>Tổng</span></li>
                                @foreach($carts as $cart)
                                <li class="fw-normal">{{$cart->products->name}}({{$cart->color}},{{$cart->size}}) x {{$cart->qty}} <span>{{number_format($cart->products->discount != null ?$cart->products->discount* $cart->qty:$cart->products->price* $cart->qty, 0, ",", ".")}} VND<span class="typcn typcn-vendor-microsoft"></span></span></li>
                                @endforeach
                                <li class="total-price">Tổng đơn hàng<span> {{number_format($total, 0, ",", ".")}} VND</span></li>
                            </ul>
                            <div class="order-btn">
                                <button type="submit" class="site-btn place-btn">Đặt hàng</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<!-- Shopping Cart Section End -->
@endsection
