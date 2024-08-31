
@extends("front.layout.master")

@section('title','Danh sách đơn hàng')

@section('body')
    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text product-more">
                        <a href=""><i class="fa fa-home"></i> Trang chủ</a>
                        <span>Danh sách đơn hàng</span>
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
                <div class="row">
                    @if(count($orders) >0)
                        <div class="col-lg-12">
                            <div class="cart-table">
                                <table>
                                    <thead>
                                    <tr>
                                        <th>Ngày đặt hàng</th>
                                        <th>Tổng tiền</th>
                                        <th>Trạng thái đơn hàng</th>
                                        <th>Chức năng</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($orders as $order)
                                        <tr data-id="{{$order->id}}">
                                            <td style="padding: 10px 10px;">
                                                {{date_format($order->created_at,"d / m / Y")}}
                                            </td>
                                            <td style="padding: 10px 10px;"> {{number_format($order->total, 0, ",", ".")}} VND</td>
                                            <td class="status" style="color: green; padding: 10px 10px;font-size: 20px;">{{$order->status}}</td>
                                            <td style="padding: 10px 10px;">
                                                @if($order->status == "Chờ xử lý")
                                                    <a href="order/myOrder/{{$order->id}}" title="Xem chi tiết" class="btn btn-primary"><i class="ti-eye"></i></a>
                                                    <a href="order/cancel/{{$order->id}}" class="btn btn-danger cancelOrder" title="Hủy đơn hàng"><i class="ti-trash"></i></a>
                                                @elseif($order->status == "Đang giao hàng")
                                                    <a href="order/myOrder/{{$order->id}}" title="Xem chi tiết" class="btn btn-primary"><i class="ti-eye"></i></a>
                                                    <a href="order/submit/{{$order->id}}" class="btn btn-warning submitOrder" title="Nhận hàng"><i class="ti-check"></i></a>
                                                @else
                                                    <a href="order/myOrder/{{$order->id}}" title="Xem chi tiết" class="btn btn-primary"><i class="ti-eye"></i></a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    @else
                        <div class="col-lg-12" style="text-align: center">
                            <div class="col-lg-12" style="text-align: center">
                                <h3>Danh sách đơn hàng đang trống</h3>
                                <br>
                                <a href="/shop" class="btn btn-primary"><h5>Quay lại trang sản phẩm</h5></a>
                            </div>
                        </div>
                    @endif
                </div>
            </form>
        </div>
    </section>
    <!-- Shopping Cart Section End -->
@endsection
