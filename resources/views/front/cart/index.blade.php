
@extends("front.layout.master")

@section('title','Cart')

@section('body')
    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text product-more">
                        <a href=""><i class="fa fa-home"></i> Trang chủ</a>
                        <span>Giỏ hàng</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->

    <!-- Shopping Cart Section Begin -->
    <section class="shopping-cart spad">
        <div class="container">
            <form action="" method="get">
                @if(count($delCarts) > 0)
                    <div class="alert alert-warning del-noti" role="alert">
                        Các sản phẩm:
                        @foreach($delCarts as $delCart)
                            {{$delCart}},
                        @endforeach đã hết hàng.Vui lòng xóa sản phẩm hoặc thay đổi đặc điểm của sản phẩm.
                    </div>
                @endif
                @if(count($changeQty) > 0)
                    <div class="alert alert-warning change-noti" role="alert">
                        Các sản phẩm:
                        @foreach($changeQty as $change)
                            {{$change}},
                        @endforeach không còn đủ số lượng.Vui lòng thay đổi số lượng sản phẩm hoặc thay đổi đặc điểm của sản phẩm.
                    </div>
                @endif
                <div class="row">
                    @if(count($carts) >0)
                        <div class="col-lg-12">
                            <div class="cart-table">
                                <table>
                                    <thead>
                                        <tr>
                                            <th>Hình ảnh</th>
                                            <th class="p-name">Tên sản phẩm</th>
                                            <th>Màu sắc</th>
                                            <th>Kích cỡ</th>
                                            <th>Đơn giá</th>
                                            <th>Số lượng</th>
                                            <th>Tổng tiền</th>
                                            <th><a title="Xóa toàn bộ"><i onclick="destroyCart()" class="ti-trash"></i></a></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($carts as $cart)
                                        <tr data-id="{{$cart->id}}">
                                            <td style="width: 150px;height: 150px; padding: 10px 10px;" class="cart-pic first-row"><img src="front/img/products/{{$cart->products->productImages[0]->path}}" alt=""></td>
                                            <td class="cart-title first-row">
                                                <h5>{{$cart->products->name}}</h5>
                                            </td>
                                            <td class=" first-row cart-color">
                                                <select style="border: 1px solid; border-radius: 4px;padding: 5px 5px;" name="color" data-id="{{$cart->id}}">
                                                    @foreach(array_unique(array_column($cart->products->productDetails->toArray(),'color')) as $productColor )
                                                        <option {{$cart->color == $productColor ? 'selected' : ''}} value="{{$productColor}}">{{$productColor}}</option>
                                                    @endforeach

                                                </select>
                                            </td>
                                            <td class="first-row cart-size">
                                                <select style="border: 1px solid; border-radius: 4px;padding: 5px 5px;" name="size"  data-id="{{$cart->id}}">
                                                    @foreach(array_unique(array_column($cart->products->productDetails->toArray(),'size')) as $productSize )
                                                        <option {{$cart->size == $productSize ? 'selected' : ''}} value="{{$productSize}}">{{$productSize}}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class="p-price first-row">{{$cart->products->discount !=null? number_format($cart->products->discount, 0, ",", "."):number_format($cart->products->price, 0, ",", ".")}} VND</td>
                                            <td class="qua-col first-row">
                                                <div class="quantity">
                                                    <div class="pro-qty">
                                                        <input type="text" value="{{$cart->qty}}" data-id="{{$cart->id}}">
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="total-price first-row">{{$cart->products->discount !=null? number_format($cart->products->discount * $cart->qty, 0, ",", "."):number_format($cart->products->price * $cart->qty, 0, ",", ".")}} VND</td>
                                            <td class="close-td first-row"><a class="btn btn-danger" onclick="deleteCart('{{$cart->id}}')" title="Xóa"><i class="ti-trash"></i></a></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="cart-buttons">
                                        <a href="shop" class="primary-btn continue-shop">Quay lại trang sản phẩm</a>
                                    </div>
                                </div>
                                <div class="col-lg-4 offset-lg-4">
                                    <div class="proceed-checkout">
                                        <ul>
                                            <li class="cart-total">Tổng tiền <span>{{number_format($total, 0, ",", ".")}} VND</span></li>
                                        </ul>
                                        <a href="checkout" class="proceed-btn">Mua hàng</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="col-lg-12" style="text-align: center">
                            <h2>Giỏ hàng đang trống</h2>
                            <br>
                            <a href="/shop" class="btn btn-primary"><h5>Trở về trang sản phẩm</h5></a>
                        </div>
                    @endif
                </div>
            </form>
        </div>
    </section>
    <!-- Shopping Cart Section End -->

@endsection
