@extends("admin.layout.master")

@section('title','Hình ảnh sản phẩm')

@section('body')
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div style="display: flex;" class="card-header py-3">
                    @if(session('create_pro') == 1)
                        <a style="margin-right: 10px;" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Trở lại"><i class="fas fa-chevron-circle-left"></i></a>
                        <h4 class="m-0 font-weight-bold text-primary float-left">Tạo Sản phẩm</h4>
                    @endif
                    @if(session('update_pro') == 1)
                        <a href="admin/product"  style="margin-right: 10px;" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Trở lại"><i class="fas fa-chevron-circle-left"></i></a>
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
                                        <a href="admin/product/{{$product->id}}/detail" class="btn" style="font-size: 18px;display: block;{{(request()->segment(4)=='detail') ? 'color:red;' : 'color:gray;'}}"> Số lượng theo chi tiết</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <hr>
                    @endif
                        <br>
                        @if(session('notification'))
                            <div class="alert alert-warning" role="alert">
                                {{session('notification')}}
                            </div>
                        @endif
                        @if(session('success'))
                            <div class="alert alert-success" role="alert">
                                {{session('success')}}
                            </div>
                        @endif
                    <div class="position-relative row form-group">
                        <label for="name" class="col-md-3 text-md-right col-form-label">Tên sản phẩm </label>
                        <div class="col-md-9 col-xl-8">
                            <input disabled placeholder="Product Name" type="text"
                                   class="form-control" value="{{$product->name}}">
                        </div>
                    </div>

                    <div class="position-relative row form-group">
                        <label for="" class="col-md-3 text-md-right col-form-label">Hình ảnh sản phẩm</label>
                        <div class="col-md-9 col-xl-8">
                            <ul class="text-nowrap" id="images">
                                @foreach($product->productImages as $image)
                                    <li class="float-left d-inline-block mr-2 mb-2" style="width: 32%;">
                                        <form action="admin/product/{{$product->id}}/image/{{$image->id}}" method="post">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" title="Xóa"
                                                    class="btn btn-sm btn-outline-danger border-0 position-absolute dltBtn">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </form>
                                        <div style="width: 100%;height: 220px; overflow: hidden;">
                                            <img style="display: inline;border-style: none;width: 100%;height: 100%;object-fit: fill;"
                                                 src="front/img/products/{{$image->path}}"
                                                 alt="Image">
                                        </div>
                                    </li>
                                @endforeach

                                <li class="float-left d-inline-block mr-2 mb-2" style="width: 32%;">
                                    <form method="post" action="admin/product/{{$product->id}}/image" enctype="multipart/form-data">
                                        @csrf
                                        <div style="width: 100%; height: 220px; overflow: hidden;">
                                            <img style="display: inline;border-style: none;width: 100%;height: 100%;object-fit: fill;cursor: pointer;"
                                                 class="thumbnail"
                                                 data-toggle="tooltip" title="Click to add image" data-placement="bottom"
                                                 src="admin/img/add-image-icon.jpg" alt="Add Image">

                                            <input title="Thêm hình ảnh" name="image" type="file" onchange="changeImg(this); this.form.submit();"
                                                   accept="image/x-png,image/gif,image/jpeg"
                                                   class="add_image form-control-file" style="display: none;">

                                            <input type="hidden" name="product_id" value="{{$product->id}}">
                                        </div>
                                    </form>
                                </li>


                            </ul>
                        </div>
                    </div>
                        <hr>
                    @if(session('create_pro') == 1)
                            <a href="admin/checkImg/{{$product->id}}" class="btn btn-primary" title="Thêm số lượng theo chi tiết">Tiếp theo  <i class="fas fa-arrow-circle-right"></i></a>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
