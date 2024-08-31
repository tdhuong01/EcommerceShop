
@extends("front.layout.master")

@section('title','Chi tiết đơn hàng')

@section('body')
    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text product-more">
                        <a href=""><i class="fa fa-home"></i> Trang chủ</a>
                        <a href="/order/myOrder"><i class="fa fa-shopping-bag"></i> Danh sách đơn hàng</a>
                        <span>Chi tiết đơn hàng</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->

    <!-- Shopping Cart Section Begin -->
    <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                    <div class="col-lg-12">
                        <div class="cart-table">
                            <table>
                                <thead>
                                <tr>
                                    <th>Hình ảnh</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Màu sắc</th>
                                    <th>Kích thước</th>
                                    <th>Giá</th>
                                    <th>Số lượng</th>
                                    <th>Tổng</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach($orders as $order)
                                        <tr>
                                            <td style="width: 100px;height: 100px; padding: 10px 10px;" class="cart-pic first-row"><img src="front/img/products/{{$order->product->productImages[0]->path}}" alt=""></td>
                                            <td class="first-row">{{$order->product->name}}</td>
                                            <td class="first-row">{{$order->color}}</td>
                                            <td class="first-row">{{$order->size}}</td>
                                            <td class="first-row">{{number_format($order->amount, 0, ",", ".")}} VND</td>
                                            <td class="first-row">{{$order->qty}}</td>
                                            <td class="first-row">{{number_format($order->total, 0, ",", ".")}} VND</td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>

                        </div>
                    </div>
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->
@endsection
