@extends('front.layout.master')

@section('title', 'Sản phẩm')

@section('body')

    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="#"><i class="fa fa-home"></i> Trang chủ</a>
                        <span>Sản phẩm</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->

    <!-- Product Shop Section Begin -->
    <section class="product-shop spad">
        <div class="container">
            <div class="row">
                <div style="border-right:1px solid #da04d5 " class="col-lg-3 col-md-6 col-sm-8 order-2 order-lg-1 produts-sidebar-filter">
                    <form action="{{ request()->segment(2) == 'product' ? 'shop' : '' }}">
                        <div class="filter-widget">
                            <h4 class="fw-title">Danh mục sản phẩm</h4>
                            <ul class="filter-catagories" id="scroll">
                                <li><a href="shop">Tất cả sản phẩm</a></li>
                                @foreach ($categories as $category)
                                    <li><a href="shop/category/{{ $category->id }}">{{ $category->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="filter-widget">
                            <h4 class="fw-title">Thương hiệu</h4>
                            <div class="fw-brand-check" id="scroll">
                                @foreach ($brands as $brand)
                                    <div class="bc-item">
                                        <label for="bc-{{ $brand->id }}">
                                            {{ $brand->name }}
                                            <input type="checkbox"
                                                {{ (request('brand')[$brand->id] ?? '') == 'on' ? 'checked' : '' }}
                                                id="bc-{{ $brand->id }}" name="brand[{{ $brand->id }}]"
                                                onchange="this.form.submit();">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="filter-widget">
                            <h4 class="fw-title">Lọc theo giá</h4>
                            <div class="filter-range-wrap">
                                <div class="range-slider">
                                    <div class="price-input">
                                        <input type="text" id="minamount" name="price_min">
                                        <input type="text" id="maxamount" name="price_max">
                                        <span>VND</span>
                                    </div>
                                </div>
                                <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                    data-min="0" data-max="99999999" data-min-value="{{ request('price_min') }}"
                                    data-max-value="{{ request('price_max') }}">
                                    <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                </div>
                            </div>
                            <button type="submit" class="filter-btn">Áp dụng</button>
                        </div>
                        <div class="filter-widget">
                            <h4 class="fw-title">Màu sắc</h4>
                            <div class="fw-color-choose">
                                @foreach($colors as $color)
                                    <div class="cs-item">
                                        <input type="radio" class="color-rdo" id="cs-{{$color->color}}" name="color" value="{{$color->color}}"
                                               onchange="this.form.submit();" {{ request('color') == $color->color ? 'checked' : '' }}>
                                        <label for="cs-{{$color->color}}" class="{{ request('color') == $color->color ? 'active' : '' }}">{{$color->color}}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <br>
                        <div class="filter-widget">
                            <h4 class="fw-title">Kích cỡ</h4>
                            <div class="fw-size-choose">
                                @foreach($sizes as $size)
                                    <div class="sc-item">
                                        <input type="radio" class="size-rdo" id="s-{{$size->size}}" name="size" value="{{$size->size}}"
                                               onchange="this.form.submit();" {{ request('size') == $size->size ? 'checked' : '' }}>
                                        <label for="s-{{$size->size}}" class="{{ request('size') == $size->size ? 'active' : '' }}">{{$size->size}}</label>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-9 order-1 order-lg-2">
                    <div class="product-show-option">
                        <div class="row">
                            <div class="col-lg-7 col-md-7">
                                <form action="">
                                    <div class="select-option">
                                        <select name="sort_by" onchange="this.form.submit()" class="sorting">
                                            <option
                                                {{ request('sort_by') == 'latest' || request('sort_by') == '' ? 'selected' : '' }}
                                                value="latest">Sắp xếp: Mới nhất</option>
                                            <option {{ request('sort_by') == 'oldest' ? 'selected' : '' }} value="oldest">
                                                Sắp xếp: Cũ nhất</option>
                                            <option {{ request('sort_by') == 'name-ascending' ? 'selected' : '' }}
                                                value="name-ascending">Sắp xếp: Tên A-Z</option>
                                            <option {{ request('sort_by') == 'name-descending' ? 'selected' : '' }}
                                                value="name-descending">Sắp xếp: Tên Z-A</option>
                                            <option {{ request('sort_by') == 'price-ascending' ? 'selected' : '' }}
                                                value="price-ascending">Sắp xếp: Giá tăng dần</option>
                                            <option {{ request('sort_by') == 'price-descending' ? 'selected' : '' }}
                                                value="price-descending">Sắp xếp: Giá giảm dần</option>
                                        </select>
                                        <select name="show" onchange="this.form.submit()" class="p-show">
                                            <option {{ request('show') == '3' ? 'selected' : '' }} value="3">Hiện: 3
                                            </option>
                                            <option {{ request('show') == '9' || request('show') == '' ? 'selected' : '' }}
                                                value="9">Hiện: 9</option>
                                            <option {{ request('show') == '15' ? 'selected' : '' }} value="15">Hiện:
                                                15</option>
                                        </select>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                    @if (count($products) > 0)
                        <div class="product-list">
                            <div class="row">
                                @foreach ($products as $product)
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="product-item">
                                            <div class="pi-pic">
                                                <a href="shop/product/{{ $product->id }}"><img style="height: 300px"
                                                        src="front/img/products/{{ $product->productImages[0]->path }}"
                                                        alt=""></a>
                                                @if ($product->discount != null)
                                                    <div class="sale pp-sale">Giảm giá</div>
                                                @endif
                                                <ul>
                                                    @if (\Illuminate\Support\Facades\Auth::check())
                                                        <li class="w-icon detail active"><a
                                                                href="javascript:chooseCart({{ $product->id }})"
                                                                title="Thêm vào giỏ hàng"><i class="icon_bag_alt"></i></a>
                                                        </li>
                                                    @else
                                                        <li class="w-icon detail active"><a href="account/login"
                                                                title="Thêm vào giỏ hàng"><i class="icon_bag_alt"></i></a>
                                                        </li>
                                                    @endif
                                                    <li class="quick-view"><a href="shop/product/{{ $product->id }}"
                                                            title="Xem chi tiết"><i class="fa fa-eye"></i> Chi tiết</a>
                                                    </li>
                                                    @if (\Illuminate\Support\Facades\Auth::check())
                                                        <li class="w-icon detail"><a
                                                                href="javascript:chooseWishlist({{ $product->id }})"
                                                                title="Thêm vào danh sách yêu thích"><i
                                                                    class="fa fa-heart-o"></i></a></li>
                                                    @else
                                                        <li class="w-icon detail"><a href="account/login"
                                                                title="Thêm vào danh sách yêu thích"><i
                                                                    class="fa fa-heart-o"></i></a></li>
                                                    @endif
                                                </ul>
                                            </div>
                                            <div class="pi-text">
                                                <div class="catagory-name">{{ $product->brands->name }}</div>
                                                <a href="shop/product/{{ $product->id }}">
                                                    <h6>{{ $product->name }}</h6>
                                                </a>
                                                <div style="font-size: 18px;" class="product-price">
                                                    @if($product->discount != null)
                                                        {{number_format($product->discount, 0, ",", ".") }} VND
                                                        <span style="font-size: 12px">{{number_format($product->price, 0, ",", ".")}} VND</span>
                                                    @else
                                                        {{number_format($product->price, 0, ",", ".")}} VND
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        {{ $products->links() }}
                    @else
                        <div style="text-align: center">
                            <h3>Không có sản phẩm nào</h3>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <!-- Product Shop Section End -->

@endsection
