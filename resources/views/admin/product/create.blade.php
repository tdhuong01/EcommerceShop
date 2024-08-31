@extends("admin.layout.master")

@section('title','Tạo mới sản phẩm')

@section('body')
    <div class="card">
        <div style="display: flex;" class="card-header py-3">
            <a href="admin/product"  style="margin-right: 10px;" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Trở lại"><i class="fas fa-chevron-circle-left"></i></a>
            <h4 class="m-0 font-weight-bold text-primary float-left">Tạo sản phẩm</h4>
        </div>
        <div class="card-body">
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
            @if(session('notification'))
                <div class="alert alert-warning" role="alert">
                    {{session('notification')}}
                </div>
            @endif
            <form method="post" action="admin/product">
                @csrf
                <div class="form-group">
                    <label for="inputTitle" class="col-form-label">Tên sản phẩm <span class="text-danger">*</span></label>
                    <input id="inputTitle" type="text" name="name" required placeholder="Nhập tên sản phẩm..."  value="" class="form-control">
                </div>

                <div class="form-group">
                    <label for="summary" class="col-form-label">Mô tả sơ lược <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="summary" required placeholder="Nhập mô tả sơ lược..." name="content"></textarea>
                </div>
                <div class="form-group">
                    <label for="description" class="col-form-label">Mô tả chi tiết</label>
                    <textarea class="form-control" id="description" name="description"></textarea>
                </div>
                <div class="form-group">
                    <label for="is_featured">Đặc sắc</label><br>
                    <input type="checkbox" name='featured' id='is_featured' value='1' checked> Có
                </div>

                <div class="form-group">
                    <label for="condition">Bộ sưu tập</label>
                    <select required name="tag" class="form-control">
                        <option value="">--Chọn bộ sưu tập--</option>
                        <option value="Thời trang nam">Thời trang nam</option>
                        <option value="Thời trang nữ">Thời trang nữ</option>
                        <option value="Thời trang trẻ em">Thời trang trẻ em</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="cat_id">Danh mục <span class="text-danger">*</span></label>
                    <select required name="product_category_id" id="cat_id" class="form-control">
                        <option value="">--Chọn danh mục sản phẩm--</option>
                        @foreach($categories as $cat_data)
                            <option value='{{$cat_data->id}}'>{{$cat_data->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="brand_id">Thương hiệu <span class="text-danger">*</span></label>
                    <select required name="brand_id" class="form-control">
                        <option value="">--Chọn thương hiệu--</option>
                            @foreach($brands as $brand)
                                <option value="{{$brand->id}}">{{$brand->name}}</option>
                            @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="price" class="col-form-label">Giá liêm yết <span class="text-danger">*</span></label>
                    <input id="price" type="number" min="0" name="price" required placeholder="Nhập giá liên yết..." class="form-control">
                </div>

                <div class="form-group">
                    <label for="discount" class="col-form-label">Giá giảm <span class="text-danger">*</span></label>
                    <input id="discount" type="number" min="0" name="discount" min="0" placeholder="Nhập giá sản phẩm sau khi giảm..."  value="" class="form-control">

                </div>
                <div class="form-group mb-3">
                    <button type="reset" class="btn btn-warning"><i class="fas fa-sync-alt"></i></button>
                    <button class="btn btn-success" type="submit"><i class="fas fa-save"></i> Lưu</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace("description");
    </script>
@endsection
