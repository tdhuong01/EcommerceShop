@extends("admin.layout.master")

@section('title','Trang chủ')

@section('body')

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Trang chủ</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Tổng doanh thu</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{number_format($total, 0, ",", ".")}} VND</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Tổng sản phẩm</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{count($product)}}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-cubes fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tổng đơn hàng
                                            </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{count($orders)}}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-hammer fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Pending Requests Card Example -->
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Đơn hàng cần xử lý</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{count($pendingOrders)}}</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-spinner fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div style="border: 2px solid #F3D9D9BD; margin-bottom: 20px;">
                        <div style="padding: 10px " class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Đơn hàng cần xử lý</h1>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                @if(count($pendingOrders)>0)
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th>Họ tên</th>
                                            <th>Email</th>
                                            <th>Số điện thoại</th>
                                            <th>Tổng tiền</th>
                                            <th>Địa chỉ</th>
                                            <th>Trạng thái</th>
                                            <th>Hành động</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($pendingOrders as $order)
                                            <tr>
                                                <td>{{$order->name}}</td>
                                                <td>{{$order->email}}</td>
                                                <td>
                                                    {{$order->phone}}
                                                </td>
                                                <td>{{number_format($order->total, 0, ",", ".")}} VND</td>
                                                <td>{{$order->address}}, {{$order->city}}, {{$order->country}}</td>
                                                <td>{{$order->status}}</td>
                                                <td style="display: flex;align-items: center;">
                                                    <a href="admin/order/orderDetail/{{$order->id}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="Xem chi tiết đơn hàng" data-placement="bottom"><i class="fas fa-info"></i></a>
                                                    <a href="admin/order/submit/{{$order->id}}" class="btn btn-warning btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="Xác nhận đơn hàng" data-placement="bottom"><i class="fas fa-check"></i></a>
                                                    <a href="admin/order/cancel/{{$order->id}}" class="btn btn-danger btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="Hủy đơn hàng" data-placement="bottom"><i class="fas fa-trash-alt"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                    {{--                    <span>{{$users->links()}}</span>--}}
                                @else
                                    <h3 class="text-center">Không có đơn hàng nào cần xử lý</h3>
                                @endif
                            </div>
                        </div>
                    </div>
                    {{-- <div style="border: 2px solid #F3D9D9BD; margin-bottom: 20px;">
                        <div style="padding: 10px " class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Thống kê</h1>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                @if(count($pendingOrders)>0)
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                        <tr>
                                            <th>Mã đơn hàng</th>
                                            <th>Thời gian</th>
                                            <th>Tổng tiền</th>
                                            <th>Hành động</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($pendingOrders as $order)
                                            <tr>
                                                <td>{{$order->name}}</td>
                                                <td>{{$order->email}}</td>
                                                <td style="display: flex;align-items: center;">
                                                    <a href="admin/order/orderDetail/{{$order->id}}" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="View" data-placement="bottom"><i class="fas fa-info"></i></a>
                                                    <a href="admin/order/submit/{{$order->id}}" class="btn btn-warning btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="Submit" data-placement="bottom"><i class="fas fa-check"></i></a>
                                                    <a href="admin/order/cancel/{{$order->id}}" class="btn btn-danger btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="Cancel" data-placement="bottom"><i class="fas fa-trash-alt"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <h3 class="text-center">Không tìm thấy kết quả</h3>
                                @endif
                            </div>
                        </div>
                    </div> --}}


                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
@endsection
