@extends("admin.layout.master")

@section('title','Thêm mới chi tiết theo sản phẩm')

@section('body')
    <div class="card">
        <div style="display: flex;" class="card-header py-3">
            @if(session('create_pro') == 1)
                <a style="margin-right: 10px;" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Trở lại"><i class="fas fa-chevron-circle-left"></i></a>
                <h4 class="m-0 font-weight-bold text-primary float-left">Tạo Sản phẩm</h4>
            @endif
            @if(session('update_pro') == 1)
                <a href="admin/product/{{$product->id}}/detail"  style="margin-right: 10px;" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Trở lại"><i class="fas fa-chevron-circle-left"></i></a>
                <h4 class="m-0 font-weight-bold text-primary float-left">Chỉnh sửa sản phẩm</h4>
            @endif
        </div>
        <div class="card-body">
            @if(session('create_pro') == 1)
                <div style="display: flex; height: 20px;">
                    <div style="display: inline-flex;position: relative;">
                        <ul style="padding: 0;margin: 0;">
                            <li style="list-style: none;display: inline-block;margin-left: -5px;position: relative;">
                                <a class="btn" style="font-size: 18px;display: block; {{(request()->segment(3)=='create') ? 'color:red;' : 'color:gray;'}}"> Thông tin cơ bản</a>
                            </li>
                            <li style="list-style: none;display: inline-block;margin-left: -5px;position: relative;"><i class="fas fa-angle-double-right"></i></li>
                            <li style="list-style: none;display: inline-block;margin-left: -5px;position: relative;">
                                <a class="btn " style="font-size: 18px;display: block;{{(request()->segment(4)=='image') ? 'color:red;' : 'color:gray;'}}"> Hình ảnh sản phẩm</a>
                            </li>
                            <li style="list-style: none;display: inline-block;margin-left: -5px;position: relative;"><i class="fas fa-angle-double-right"></i></li>
                            <li style="list-style: none;display: inline-block;margin-left: -5px;position: relative;">
                                <a class="btn " style="font-size: 18px;display: block;{{(request()->segment(4)=='detail') ? 'color:red;' : 'color:gray;'}}"> Số lượng theo chi tiết</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <hr>
            @endif
                @if(session('update_pro') == 1)
                    <div style="display: flex; height: 30px;justify-content: space-between;">
                        <div style="display: inline-flex;position: relative;">
                            <ul style="padding: 0;margin: 0;">
                                <li style="list-style: none;display: inline-block;margin-left: -5px;position: relative;">
                                    <a href="admin/product/{{$product->id}}/edit" class="btn" style="font-size: 18px; {{(request()->segment(4)=='edit') ? 'color:red;' : 'color:gray;'}}"> Thông tin cơ bản</a>
                                </li>
                                <li style="list-style: none;display: inline-block;margin-left: -5px;position: relative;"><i class="fas fa-grip-lines-vertical"></i></li>
                                <li style="list-style: none;display: inline-block;margin-left: -5px;position: relative;">
                                    <a href="admin/product/{{$product->id}}/image" class="btn " style="font-size: 18px;display: block;{{(request()->segment(4)=='image') ? 'color:red;' : 'color:gray;'}}"> Hình ảnh sản phẩm</a>
                                </li>
                                <li style="list-style: none;display: inline-block;margin-left: -5px;position: relative;"><i class="fas fa-grip-lines-vertical"></i></li>
                                <li style="list-style: none;display: inline-block;margin-left: -5px;position: relative;">
                                    <a href="admin/product/{{$product->id}}/detail" class="btn " style="font-size: 18px;display: block;{{(request()->segment(4)=='detail') ? 'color:red;' : 'color:gray;'}}"> Số lượng theo chi tiết</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <hr>
                @endif
                @if(session('create_pro') == 1)
                    <h4 class="m-0 font-weight-bold float-left">Tạo Sản phẩm</h4>
                @endif
                @if(session('update_pro') == 1)
                    <h4 class="m-0 font-weight-bold float-left">Tạo Sản phẩm</h4>
                @endif
                <br>
                <br>
            @if(session('notification'))
                <div class="alert alert-warning" role="alert">
                    {{session('notification')}}
                </div>
            @endif
            <form method="post" action="admin/product/{{$product->id}}/detail">
                @csrf
                <input type="hidden" name="product_id" value="{{$product->id}}">
                <div class="form-group">
                    <label for="inputTitle" class="col-form-label">Tên sản phẩm <span class="text-danger">*</span></label>
                    <input id="inputTitle" type="text" name="name" disabled value="{{$product->name}}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="inputTitle" class="col-form-label">Màu sắc <span class="text-danger">*</span></label>
                    <input id="inputTitle" type="text" name="color" class="form-control">
                </div>
                <div class="form-group">
                    <label for="condition">Kích cỡ <span class="text-danger">*</span></label>
                    <select required name="size" class="form-control">
                        <option value="">--Kích cỡ--</option>
                        <option value="XS">XS</option>
                        <option value="S">S</option>
                        <option value="M">M</option>
                        <option value="L">L</option>
                        <option value="XL">XL</option>
                        <option value="XXL">XXL</option>
                        <option value="Oversize">Oversize</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="inputTitle" class="col-form-label">Số lượng <span class="text-danger">*</span></label>
                    <input id="inputTitle" type="number" min="0" name="qty" placeholder="Nhập số lượng..."  value="" class="form-control">
                </div>

                <div class="form-group mb-3">
                    <button type="reset" class="btn btn-warning"><i class="fas fa-sync-alt"></i></button>
                    <button class="btn btn-success" type="submit"><i class="fas fa-save"></i> Lưu</button>
                    @if(session('create_pro') == 1)
                        <a href="admin/submitCreate" class="btn btn-primary " title="Kết thúc"> <i class="fas fa-save"></i> Hoàn tất thêm sản phẩm</a>
                    @endif
                </div>
            </form>
        </div>
    </div>


@endsection
