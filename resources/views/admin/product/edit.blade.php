@extends("admin.layout.master")

@section('title','Chỉnh sửa sản phẩm')

@section('body')
    <div class="card">
        <div style="display: flex;" class="card-header py-3">
            <a href="admin/product"  style="margin-right: 10px;" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Trở lại"><i class="fas fa-chevron-circle-left"></i></a>
            <h4 class="m-0 font-weight-bold text-primary float-left">Chỉnh sửa sản phẩm</h4>
        </div>
        <div class="card-body">
            <div style="display: flex;justify-content: space-between;height: 30px;">
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
            <div class="py-3">
                <h4 class="m-0 font-weight-bold float-left">Thông tin cơ bản</h4>
            </div>
            <br>
            @if(session('success'))
                <div class="alert alert-success" role="alert">
                    {{session('success')}}
                </div>
            @endif
            <form method="post" action="admin/product/{{$products->id}}">
                @csrf
                @method('put')
                <div class="form-group">
                    <label for="inputTitle" class="col-form-label">Tên sản phẩm <span class="text-danger">*</span></label>
                    <input id="inputTitle" type="text" name="name" disabled placeholder="Nhập tên sản phẩm..."  value="{{$products->name}}" class="form-control">
                </div>

                <div class="form-group">
                    <label for="summary" class="col-form-label">Mô tả sơ lược <span class="text-danger">*</span></label>
                    <textarea class="form-control" id="summary" required  placeholder="Nhập mô tả sơ lược..." name="content">{{$products->content}}</textarea>
                </div>
                <div class="form-group">
                    <label for="description" class="col-form-label">Mô tả chi tiết</label>
                    <textarea class="form-control" id="description"  name="description">{{$products->description}}</textarea>
                </div>
                <div class="form-group">
                    <label for="is_featured">Đặc sắc</label><br>
                    <input type="checkbox" name='featured' id='is_featured' value='1'{{$products->featured ? 'checked': ''}} > Có
                </div>
                <div class="form-group">
                    <label for="condition">Bộ sưu tập</label>
                    <select required name="tag" class="form-control">
                        <option value="">--Chọn bộ sưu tập--</option>
                        <option {{$products->tag == 'Thời trang nam' ? 'selected' : ''}} value="Thời trang nam">Thời trang nam</option>
                        <option {{$products->tag == 'Thời trang nữ' ? 'selected' : ''}} value="Thời trang nữ">Thời trang nữ</option>
                        <option {{$products->tag == 'Thời trang trẻ em' ? 'selected' : ''}} value="Thời trang trẻ em">Thời trang trẻ em</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="cat_id">Danh mục <span class="text-danger">*</span></label>
                    <select required name="product_category_id" id="cat_id" class="form-control">
                        <option value="">--Chọn danh mục sản phẩm--</option>
                        @foreach($categories as $cat_data)
                            <option {{$products->productCategory->id == $cat_data->id ? 'selected' : ''}}
                                value='{{$cat_data->id}}'>{{$cat_data->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="brand_id">Thương hiệu</label>
                    <select required name="brand_id" class="form-control">
                        <option value="">--Chọn thương hiệu sản phẩm--</option>
                            @foreach($brands as $brand)
                                <option {{$products->brands->id == $brand->id ? 'selected' : ''}}
                                    value="{{$brand->id}}">{{$brand->name}}</option>
                            @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="price" class="col-form-label">Giá liêm yết <span class="text-danger">*</span></label>
                    <input id="price" type="number" min="0" required name="price" placeholder="Nhập giá liêm yết của sản phẩm..." value="{{$products->price}}" class="form-control">
                </div>

                <div class="form-group">
                    <label for="discount" class="col-form-label">Giá giảm</label>
                    <input id="discount" type="number" min="0" name="discount"  placeholder="Nhập giá sản phẩm sau khi giảm..."  value="{{$products->discount}}" class="form-control">

                </div>

                <div class="form-group mb-3">
                    <button type="reset" class="btn btn-warning" title="Reload"><i class="fas fa-sync-alt"></i></button>
                    <button class="btn btn-success" type="submit">Cập nhật</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace("description");

    </script>
@endsection
