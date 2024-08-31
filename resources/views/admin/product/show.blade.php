@extends("admin.layout.master")

@section('title','Thông tin sản phẩm')

@section('body')
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header py-3">
                    <h4 class="m-0 font-weight-bold text-primary float-left"> Thông tin sản phẩm</h4>
                </div>
                <div style="display: flex;justify-content: space-between; padding:0px 20px;" class="py-3">
                    <a href="admin/product" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Trở lại"><i class="fas fa-chevron-circle-left"></i></a>
                    <a href="admin/product/{{$product->id}}/edit" class="btn btn-primary btn-sm" data-toggle="tooltip" data-placement="bottom" title="Chỉnh sửa sản phẩm"><i class="fas fa-edit"></i> Chỉnh sửa sản phẩm</a>
                </div>
                <div style="margin-left: 10%" class="card-body display_data">
                    <div class="position-relative row1 form-group">
                        <label for="name" class="col-md-3  col-form-label">Tên sản phẩm</label>
                        <div class="col-md-9 col-xl-8">
                            <p style="font-size: 30px;font-weight: bold;">{{$product->name}}</p>
                        </div>
                    </div>
                    <div class="position-relative row form-group">
                        <label for="" class="col-md-3  col-form-label">Hình ảnh sản phẩm</label>
                        <div class="col-md-9 col-xl-8" >
{{--                            <label for="" class="col-form-label">Images</label>--}}
                            <ul class="text-nowrap img1 overflow-auto" id="images">
                                @foreach($product->productImages as $productImage)
                                    <li class="d-inline-block mr-1" style="position: relative;">
                                        <img style="height: 150px;" src="front/img/products/{{$productImage->path}}"
                                             alt="Image">
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                    <div class="position-relative row1 form-group">
                        <label for="price"
                               class="col-md-3  col-form-label">Giá liêm yết</label>
                        <div class="col-md-9 col-xl-8">
                            <p>{{number_format($product->price, 0, ",", ".")}} VND</p>
                        </div>
                    </div>

                    <div class="position-relative row1 form-group">
                        <label for="discount"
                               class="col-md-3  col-form-label">Giá giảm</label>
                        <div class="col-md-9 col-xl-8">
                            <p>{{number_format($product->discount, 0, ",", ".")}} VND</p>
                        </div>
                    </div>
                    <div class="position-relative row1 form-group">
                        <label for="qty"
                               class="col-md-3  col-form-label">Số lượng sản phẩm trong kho</label>
                        <div class="col-md-9 col-xl-8">
                            <p>{{$product->qty}}</p>
                        </div>
                    </div>
                    <div class="position-relative row1 form-group">
                        <label for="brand_id"
                               class="col-md-3  col-form-label">Số lượng sản phẩm theo đặc điểm</label>
                        <div class="col-md-9 col-xl-8" >
                            @foreach ($product->productDetails as $productDetail )
                             <p>{{$productDetail->color}}-{{$productDetail->size}} ({{$productDetail->qty}})</p>
                            @endforeach
                        </div>
                    </div>

                    <div class="position-relative row1 form-group">
                        <label for="brand_id"
                               class="col-md-3  col-form-label">Thương hiệu</label>
                        <div class="col-md-9 col-xl-8">
                            <p>{{$product->brands->name}}</p>
                        </div>
                    </div>

                    <div class="position-relative row1 form-group">
                        <label for="product_category_id"
                               class="col-md-3  col-form-label">Danh mục</label>
                        <div class="col-md-9 col-xl-8">
                            <p>{{$product->productCategory->name}}</p>
                        </div>
                    </div>
                    <div class="position-relative row1 form-group">
                        <label for="tag"
                               class="col-md-3  col-form-label">Bộ sưu tập</label>
                        <div class="col-md-9 col-xl-8">
                            <p>{{$product->tag}}</p>
                        </div>
                    </div>

                    <div class="position-relative row1 form-group">
                        <label for="content"
                               class="col-md-3  col-form-label">Mô tả sơ lược</label>
                        <div class="col-md-9 col-xl-8">
                            <p>{{$product->content}}</p>
                        </div>
                    </div>
                    <div class="position-relative row1 form-group">
                        <label for="description"
                               class="col-md-3  col-form-label">Mô tả chi tiết</label>
                        <div class="col-md-9 col-xl-8">
                            <p>{!! $product->description !!}</p>
                        </div>
                    </div>

                    <div class="position-relative row1 form-group">
                        <label for="sku"
                               class="col-md-3  col-form-label">SKU</label>
                        <div class="col-md-9 col-xl-8">
                            <p>{{$product->sku}}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
