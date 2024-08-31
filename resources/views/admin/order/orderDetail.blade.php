@extends("admin.layout.master")

@section('title','Chi tiết đơn hàng')

@section('body')

    <div class="card shadow mb-4">
        <div class="row">
            <div class="col-md-12">

            </div>
        </div>
        <div style="display: flex;" class="card-header py-3">
            <a href="admin/order"  style="margin-right: 10px;" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Trở lại"><i class="fas fa-chevron-circle-left"></i></a>
            <h4 class="m-0 font-weight-bold text-primary">Chi tiết đơn hàng</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th>Hình ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Màu sắc</th>
                        <th>Kích cỡ</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Tổng</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td><img src="front/img/products/{{$order->product->productImages[0]->path}}" class="img-fluid" style="max-width:60px" alt="image.png"></td>
                            <td>{{$order->product->name}}</td>
                            <td>{{$order->color}}</td>
                            <td>{{$order->size}}</td>
                            <td>{{number_format($order->amount, 0, ",", ".")}} VND</td>
                            <td>{{$order->qty}}</td>
                            <td>{{number_format($order->total, 0, ",", ".")}} VND</td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

