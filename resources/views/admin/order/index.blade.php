@extends("admin.layout.master")

@section('title','Danh sách đơn hàng')

@section('body')

    <div class="card shadow mb-4">
        <div class="row">
            <div class="col-md-12">

            </div>
        </div>
        <div class="card-header py-3">
            <h4 class="m-0 font-weight-bold text-primary float-left">Danh sách đơn hàng</h4>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                @if(count($orders)>0)
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr class="text-center">
                            <th>Mã</th>
                            <th>Họ tên</th>
                            <th>Số điện thoại</th>
                            <th style="width: 15%">Tổng đơn</th>
                            <th>Địa chỉ</th>
                            <th  style="width: 15%">Trạng thái</th>
                            <th>Hoạt động</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td>{{$order->id}}</td>
                                <td>{{$order->name}}</td>
                                <td>
                                    {{$order->phone}}
                                </td>
                                <td style="width: 15%" class="text-right">{{number_format($order->total, 0, ",", ".")}} VND</td>
                                <td>{{$order->address}}, {{$order->city}}, {{$order->country}}</td>
                                <td style="width: 15%">{{$order->status}}</td>
                                <td style="display: flex;align-items: center;">
                                    @if($order->status == "Chờ xử lý")
                                        <a href="admin/order/orderDetail/{{$order->id}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="View" data-placement="bottom"><i class="fas fa-info"></i></a>
                                        <a href="admin/order/submit/{{$order->id}}" class="btn btn-warning btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="Submit" data-placement="bottom"><i class="fas fa-check"></i></a>
                                        <a href="admin/order/cancel/{{$order->id}}" class="btn btn-danger btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="Cancel" data-placement="bottom"><i class="fas fa-trash-alt"></i></a>
                                    @else
                                        <a href="admin/order/orderDetail/{{$order->id}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="View" data-placement="bottom"><i class="fas fa-info"></i></a>
                                    @endif

                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
{{--                    <span>{{$users->links()}}</span>--}}
                @else
                    <h6 class="text-center">Danh sách đơn haàng trống</h6>
                @endif
            </div>
        </div>
    </div>
@endsection

