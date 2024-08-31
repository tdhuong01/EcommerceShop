@extends("admin.layout.master")

@section('title','Danh sách sản phẩm theo chi tiết')

@section('body')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="row">
            <div class="col-md-12">

            </div>
        </div>
        <div  style="display: flex;" class="card-header py-3">
            <a href="admin/product"  style="margin-right: 10px;" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Trở lại"><i class="fas fa-chevron-circle-left"></i></a>
            <h4 class="m-0 font-weight-bold text-primary">Chỉnh sửa sản phẩm</h4>
        </div>
        <div class="card-body">
            @if(session('update_pro') == 1)
                <div style="display: flex; height: 30px;justify-content: space-between;">
                    <div style="display: inline-flex;position: relative;">
                        <ul style="padding: 0;margin: 0;">
                            <li style="list-style: none;display: inline-block;margin-left: -5px;position: relative;">
                                <a href="admin/product/{{$products->id}}/edit" class="btn" style="font-size: 18px; {{(request()->segment(4)=='edit') ? 'color:red;' : 'color:gray;'}}"> Thông tin cơ bản</a>
                            </li>
                            <li style="list-style: none;display: inline-block;margin-left: -5px;position: relative;"><i class="fas fa-grip-lines-vertical"></i></li>
                            <li style="list-style: none;display: inline-block;margin-left: -5px;position: relative;">
                                <a href="admin/product/{{$products->id}}/image" class="btn " style="font-size: 18px;display: block;{{(request()->segment(4)=='image') ? 'color:red;' : 'color:gray;'}}"> Hình ảnh sản phẩm</a>
                            </li>
                            <li style="list-style: none;display: inline-block;margin-left: -5px;position: relative;"><i class="fas fa-grip-lines-vertical"></i></li>
                            <li style="list-style: none;display: inline-block;margin-left: -5px;position: relative;">
                                <a href="admin/product/{{$products->id}}/detail" class="btn " style="font-size: 18px;display: block;{{(request()->segment(4)=='detail') ? 'color:red;' : 'color:gray;'}}"> Số lượng theo chi tiết</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <hr>
            @endif
            <div style="display: flex;justify-content: space-between;" class="py-3">
                <h4 class="m-0 font-weight-bold">Danh sách sản phẩm theo chi tiết</h4>
                <a href="admin/product/{{$products->id}}/detail/create" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Add Product"><i class="fas fa-plus"></i> Thêm mới</a>
            </div>
                @if(session('notification'))
                    <div class="alert alert-success" role="alert">
                        {{session('notification')}}
                    </div>
                @endif
            <div class="table-responsive">
                @if(count($products->productDetails)>0)
                    <table class="table table-bordered" id="productDetail-dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr style="text-align: center;">
                            <th>Tên sản phẩm</th>
                            <th>Màu sắc</th>
                            <th>Kích cỡ</th>
                            <th>Số lượng</th>
                            <th>Hành động</th>
                        </tr>
                        </thead>

                        <tbody>

                        @foreach($products->productDetails as $product)
                            <tr>
                                <td>{{$products->name}} </td>
                                <td style="text-align: center;">{{$product->color}}</td>
                                <td style="text-align: center;">{{$product->size}}</td>
                                <td style="text-align: center;">{{$product->qty}}</td>
                                <td style="display: flex;justify-content: center;">
                                    <a href="admin/product/{{$products->id}}/detail/{{$product->id}}/edit" class="btn btn-primary btn-sm float-left mr-1" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" title="Sửa" data-placement="bottom"><i class="fas fa-edit"></i></a>
                                    <form method="POST" action="admin/product/{{$products->id}}/detail/{{$product->id}}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm dltBtn" type="submit" data-id="" style="height:30px; width:30px;border-radius:50%" data-toggle="tooltip" data-placement="bottom" title="Xóa"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <h6 class="text-center">Danh sách đặc điêm sản phẩm trống. Hãy thêm đặc điêm sản phẩm mới. </h6>
                @endif
            </div>
        </div>
    </div>
@endsection

