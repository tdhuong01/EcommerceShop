@extends("front.layout.master")

@section('title','Trang chủ')

@section('body')
    <!-- Hero Section Begin -->
    <section class="hero-section">
        <div class="hero-items owl-carousel">
            <div class="single-hero-items set-bg" data-setbg="front/img/bannerMS-4.jpg">
            </div>
            <div class="single-hero-items set-bg" data-setbg="front/img/bannerMS-2.png">
            </div>
            <div class="single-hero-items set-bg" data-setbg="front/img/bannerMS-3.jpg">
            </div>
        </div>
    </section>
    <!-- Hero Section End -->

    <!-- Banner Section Begin -->
    <div class="banner-section spad">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4">
                    <div class="single-banner">
                        <img style="object-fit: fill;height: 250px;" src="front/img/banner-nam.jpg" alt="">
                        <div class="inner-text">
                            <a href="shop/tag/nam">Thời trang nam</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="single-banner">
                        <img style="object-fit: fill;height: 250px;" src="front/img/banner-nu.jpg" alt="">
                        <div class="inner-text">
                            <a href="shop/tag/nu">Thời trang nữ</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="single-banner">
                        <img  style="object-fit: fill;height: 250px;" src="front/img/banner-tre.jpg" alt="">
                        <div class="inner-text">
                            <a href="shop/tag/tre">Thời trang trẻ em</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner Section End -->

    <!-- Women Banner Section Begin -->
    <section class="women-banner spad">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3">
                    <div class="product-large set-bg" data-setbg="front/img/banner-doc3.jpg">
                        <h3 style="color: #02a3fa">Thời trang nữ</h3>
                        <a style="color: #02a3fa" href="shop/tag/nu">Xem thêm</a>
                    </div>
                </div>
                <div class="col-lg-8 offset-lg-1">
                    <div class="filter-control">
                        <ul>
                            <li class="active item" data-tag="*" data-category="women">Sản phẩm nổi bật</li>
                        </ul>
                    </div>
                    <div class="product-slider owl-carousel women">
                        @foreach($featuredProducts['women'] as $product)
                        <div class="product-item item {{$product->productCategory->name}}">
                            <div class="pi-pic">
                                <a href="shop/product/{{$product->id}}"><img style="height: 300px" src="front/img/products/{{$product->productImages[0]->path}}" alt=""></a>
                                @if($product->discount != null)
                                    <div class="sale">Giảm giá</div>
                                @endif

                                <ul>
                                    @if(\Illuminate\Support\Facades\Auth::check())
                                    <li class="w-icon detail active"><a href="javascript:chooseCart({{$product->id}})" title="Thêm vào giỏ hàng"><i class="icon_bag_alt"></i></a></li>
                                    @else
                                        <li class="w-icon detail active"><a href="account/login" title="Thêm vào giỏ hàng"><i class="icon_bag_alt"></i></a></li>
                                    @endif
                                    <li class="quick-view"><a href="shop/product/{{$product->id}}" title="Chi tiết"><i class="fa fa-eye"></i> Chi tiết</a></li>
                                    @if(\Illuminate\Support\Facades\Auth::check())
                                        <li class="w-icon detail"><a href="javascript:chooseWishlist({{$product->id}})" title="Thêm vào danh sách yêu thích"><i class="fa fa-heart-o"></i></a></li>
                                    @else
                                        <li class="w-icon detail"><a href="account/login" title="Thêm vào danh sách yêu thích"><i class="fa fa-heart-o"></i></a></li>
                                    @endif
                                </ul>
                            </div>
                            <div class="pi-text">
                                <div class="catagory-name">{{$product->brands->name}}</div>
                                <a href="shop/product/{{$product->id}}">
                                    <h6>{{$product->name}}</h6>
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
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Women Banner Section End -->
<!-- Instagram Section Begin -->
<div class="instagram-photo">
    <div class="insta-item set-bg" data-setbg="front/img/pr1.jpg">
    </div>
    <div class="insta-item set-bg" data-setbg="front/img/pr2.jpg">
    </div>
    <div class="insta-item set-bg" data-setbg="front/img/pr3.jpg">
    </div>
    <div class="insta-item set-bg" data-setbg="front/img/pr6.jpg">
    </div>
    <div class="insta-item set-bg" data-setbg="front/img/pr4.jpg">
    </div>
    <div class="insta-item set-bg" data-setbg="front/img/pr5.jpg">
    </div>
</div>
    <!-- Man Banner Section Begin -->
    <section class="man-banner spad">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-8">
                    <div class="filter-control">
                        <ul>
                            <li class="active item" data-tag="*" data-category="women">Sản phẩm nổi bật</li>
                        </ul>
                    </div>
                    <div class="product-slider owl-carousel men">
                        @foreach($featuredProducts['men'] as $product)
                            <div class="product-item item {{$product->productCategory->name}}">
                                <div class="pi-pic">
                                    <a href="shop/product/{{$product->id}}"><img style="height: 300px" src="front/img/products/{{$product->productImages[0]->path}}" alt=""></a>
                                    @if($product->discount != null)
                                        <div class="sale">Sale</div>
                                    @endif
                                    <ul>
                                        @if(\Illuminate\Support\Facades\Auth::check())
                                        <li class="w-icon detail active"><a href="javascript:chooseCart({{$product->id}})" title="Thêm vào giỏ hàng"><i class="icon_bag_alt"></i></a></li>
                                        @else
                                            <li class="w-icon detail active"><a href="account/login" title="Thêm vào giỏ hàng"><i class="icon_bag_alt"></i></a></li>
                                        @endif
                                        <li class="quick-view"><a href="shop/product/{{$product->id}}" title="Chi tiết"><i class="fa fa-eye"></i> Chi tiết</a></li>
                                        @if(\Illuminate\Support\Facades\Auth::check())
                                            <li class="w-icon detail"><a href="javascript:chooseWishlist({{$product->id}})" title="Thêm vào danh sách yêu thích"><i class="fa fa-heart-o"></i></a></li>
                                        @else
                                            <li class="w-icon detail"><a href="account/login" title="Thêm vào danh sách yêu thích"><i class="fa fa-heart-o"></i></a></li>
                                        @endif
                                    </ul>
                                </div>
                                <div class="pi-text">
                                    <div class="catagory-name">{{$product->brands->name}}</div>
                                    <a href="shop/product/{{$product->id}}">
                                        <h6>{{$product->name}}</h6>
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
                        @endforeach
                    </div>
                </div>
                <div class="col-lg-3 offset-lg-1">
                    <div class="product-large set-bg m-large" data-setbg="front/img/banner-doc1.jpg">
                        <h3 style="color: #02a3fa">Thời trang nam</h3>
                        <a style="color: #02a3fa" href="shop/tag/nam">Xem thêm</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Man Banner Section End -->



    <!-- Latest Blog Section Begin -->
    <section class="latest-blog spad">
        <div class="container">
            <div class="benefit-items">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="single-benefit">
                            <div class="sb-icon">
                                <img src="front/img/icon-1.png" alt="">
                            </div>
                            <div class="sb-text">
                                <label style="font-size: 13px;font-weight:bold; text-transform: uppercase;">Miễn phí giao hàng</label>
                                <p>Tiết kiệm chi phí</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="single-benefit">
                            <div class="sb-icon">
                                <img src="front/img/icon-2.png" alt="">
                            </div>
                            <div class="sb-text">
                                <label style="font-size: 13px;font-weight:bold; text-transform: uppercase;">Giao hàng nhanh chóng</label>
                                <p>Tiết kiệm thời gian</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="single-benefit">
                            <div class="sb-icon">
                                <img src="front/img/icon-3.png" alt="">
                            </div>
                            <div class="sb-text">
                                <label style="font-size: 13px;font-weight:bold; text-transform: uppercase;">Thanh toán thuận tiện</label>
                                <p>Nhanh gọn dễ dàng</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Latest Blog Section End -->


@endsection

