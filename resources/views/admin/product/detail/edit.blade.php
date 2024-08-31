@extends("admin.layout.master")

@section('title','Chỉnh sửa số lượng')

@section('body')
    <div class="card">
        <div style="display: flex;" class="card-header py-3">
            <a href="admin/product/{{$product->id}}/detail"  style="margin-right: 10px;" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Trở lại"><i class="fas fa-chevron-circle-left"></i></a>
            <h4 class="m-0 font-weight-bold text-primary float-left">Chỉnh sửa sản phẩm</h4>
        </div>
        <div class="card-body">
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
                @if(session('update_pro') == 1)
                    <h4 class="m-0 font-weight-bold float-left">Chỉnh sửa số lượng</h4>
                @endif
                <br>
                <br>
            <form method="post" action="admin/product/{{$product->id}}/detail/{{$productDetail->id}}">
                @csrf
                @method('PUT')
                <input type="hidden" name="product_id" value="{{$product->id}}">
                <div class="form-group">
                    <label for="inputTitle" class="col-form-label">Tên sản phẩm <span class="text-danger">*</span></label>
                    <input id="inputTitle" type="text" name="name" disabled value="{{$product->name}}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="inputTitle" class="col-form-label">Màu sắc <span class="text-danger">*</span></label>
                    <input id="inputTitle" type="text" name="color" disabled value="{{$productDetail->color}}" class="form-control">
                </div>
                <div class="form-group">
                    <label for="condition">Kích thước <span class="text-danger">*</span></label>
                    <select disabled name="size" class="form-control">
                        <option value="">--Chọn kích thước--</option>
                        <option {{$productDetail->size == 'XS' ? 'selected':''}} value="XS">XS</option>
                        <option {{$productDetail->size == 'S' ? 'selected':''}} value="S">S</option>
                        <option {{$productDetail->size == 'M' ? 'selected':''}} value="M">M</option>
                        <option {{$productDetail->size == 'L' ? 'selected':''}} value="L">L</option>
                        <option {{$productDetail->size == 'XL' ? 'selected':''}} value="XL">XL</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="inputTitle" class="col-form-label">Số lượng <span class="text-danger">*</span></label>
                    <input id="inputTitle" type="number" min="0" name="qty" placeholder="Nhập số lượng..."  value="{{$productDetail->qty}}" class="form-control">
                </div>

                <div class="form-group mb-3">
                    <button type="reset" class="btn btn-warning"><i class="fas fa-sync-alt"></i></button>
                    <button class="btn btn-success" type="submit"><i class="fas fa-save"></i> Lưu</button>
                </div>
            </form>
        </div>
    </div>


@endsection
