
@extends("front.layout.master")

@section('title','Chi tiết sản phẩm')

@section('body')
    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text product-more">
                        <a href="./home"><i class="fa fa-home"></i> Trang chủ</a>
                        <a href="./shop">Sản phẩm</a>
                        <span>Chi tiết sản phẩm</span>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->

    <!-- Product Shop Section Begin -->
    <section class="product-shop spad page-details">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="product-pic-zoom">
                                <img class="product-big-img" src="front/img/products/{{$product->productImages[0]->path }}" alt="">
                                <div class="zoom-icon">
                                    <i class="fa fa-search-plus"></i>
                                </div>
                            </div>
                            <div class="product-thumbs">
                                <div class="product-thumbs-track ps-slider owl-carousel">
                                    @foreach($product->productImages as $productImage)
                                        <div class="pt active" data-imgbigurl="front/img/products/{{ $productImage->path }}"><img
                                                style="width: 100%;height: 180px;object-fit: fill;" src="front/img/products/{{ $productImage->path }}" alt=""></div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="product-details">
                                <div class="pd-title">
                                    <input class="pro-id" type="hidden" value="{{$product->id}}">
                                    <span>{{ $product->tag }}</span>
                                    <h3>{{ $product->name }}</h3>
                                </div>
                                <div class="pd-rating">
                                    @for($i=1 ; $i <= 5 ; $i++ )
                                        @if($i <= $product->avgRating)
                                            <i class="fa fa-star"></i>
                                        @else
                                            <i class="fa fa-star-o"></i>
                                        @endif
                                    @endfor
                                    <span>({{number_format($product->avgRating,1)}})</span>
                                </div>
                                <div class="pd-desc">
                                    <p>{{ $product->content }}</p>
                                    @if($product->discount != null)
                                        <h4>{{number_format($product->discount, 0, ",", ".") }} VND
                                        <span>{{number_format($product->price, 0, ",", ".")}} VND</span></h4>
                                    @else
                                        <h4>{{number_format($product->price, 0, ",", ".")}} VND</h4>
                                    @endif


                                </div>
                                <div class="pd-color">
                                    <div class="pd-color-choose">
                                        @foreach (array_unique(array_column($product->productDetails->toArray(),'color')) as $productColor )
                                            <div class="cc-item">
                                                <input type="radio" class="radio-color" name="color" required value="{{$productColor}}" id="cc-{{ $productColor }}">
                                                <label style="border: 1px solid #da04d5" for="cc-{{ $productColor }}">{{ $productColor }}</label>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>

                                <div class="pd-size-choose">
                                    @foreach (array_unique(array_column($product->productDetails->toArray(),'size')) as $productSize )
                                        <div class="sc-item">
                                            <input class="radio-size" name="size" value="{{$productSize}}" type="radio"  required id="sm-{{ $productSize }}">
                                            <label style="border: 1px solid #da04d5" for="sm-{{ $productSize }}">{{ $productSize }}</label>
                                        </div>
                                    @endforeach

                                </div>
                                <div class="quantity">
                                    <div class="choose-qty">
                                        <input class="pro-choose-qty" type="text" value="1">
                                    </div>
                                    <a style="cursor: pointer;" onclick="addCartPro()" class="primary-btn pd-cart" title="Thêm vào giỏ hàng">Thêm vào giỏ hàng</a>
                                </div>
                                <ul class="pd-tags">
                                    <li><span>Danh mục</span>: {{ $product->productCategory->name }}</li>
                                    <li><span>Bộ sưu tập</span>: {{ $product->tag }}</li>
                                </ul>
                                <div class="pd-share">
                                    <div class="p-code">Sku : {{ $product->sku }}</div>
                                    <div class="pd-social">
                                        <a><i class="ti-facebook"></i></a>
                                        <a><i class="ti-twitter-alt"></i></a>
                                        <a><i class="ti-linkedin"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product-tab">
                        <div class="tab-item">
                            <ul class="nav" style="justify-content: center;" role="tablist">
                                <li  style="border: 1px solid #da04d5">
                                    <a class="active" data-toggle="tab" href="#tab-1" role="tab">Mô tả sản phẩm</a>
                                </li>
                                <li  style="border: 1px solid #da04d5">
                                    <a data-toggle="tab" href="#tab-2" role="tab">Thông số sản phẩm</a>
                                </li>
                                <li  style="border: 1px solid #da04d5;">
                                    <a data-toggle="tab" href="#tab-3" role="tab">Nhận xét của khách hàng ({{count($product->productComments)}})</a>
                                </li>
                            </ul>
                        </div>
                        <div class="tab-item-content">
                            <div class="tab-content">
                                <div class="tab-pane fade-in active" id="tab-1" role="tabpanel">
                                    <div class="product-content">
                                        <div class="row">
                                            <div class="col-lg-7">
                                                <h5>Mô tả sản phẩm</h5>
                                                <p>{!! $product->description !!}</p>

                                            </div>
                                            <div class="col-lg-5">
                                                <img src="front/img/products/{{$product->productImages[0]->path }}" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab-2" role="tabpanel">
                                    <div class="specification-table">
                                        <table>
                                            <tr>
                                                <td class="p-catagory">Đánh giá</td>
                                                <td>
                                                    <div class="pd-rating">
                                                        @for($i=1 ; $i <= 5 ; $i++ )
                                                            @if($i <= $product->avgRating)
                                                                <i class="fa fa-star"></i>
                                                            @else
                                                                <i class="fa fa-star-o"></i>
                                                            @endif
                                                        @endfor
                                                        <span>({{number_format($product->avgRating)}})</span>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="p-catagory">Giá</td>
                                                <td>
                                                    <div class="p-price">{{ number_format($product->price, 0, ",", ".") }} VND</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="p-catagory">Số lượng trong kho</td>
                                                <td>
                                                    <div class="p-stock">{{$product->qty}}</div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="p-catagory">Kích cỡ</td>
                                                <td>
                                                    @foreach (array_unique(array_column($product->productDetails->toArray(),'size')) as $productSize )
                                                       <span class="p-size"> {{$productSize}},</span>
                                                    @endforeach

                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="p-catagory">Màu sắc</td>
                                                <td>
                                                    @foreach (array_unique(array_column($product->productDetails->toArray(),'color')) as $productColor )
                                                        <span>{{$productColor}}, </span>
                                                    @endforeach

                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="p-catagory">Sku</td>
                                                <td>
                                                    <div class="p-code">{{$product->sku}}</div>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <div class="tab-pane fade" id="tab-3" role="tabpanel">
                                    <div class="customer-review-option">
                                        <h4>{{count($product->productComments)}} bình luận</h4>
                                        <div class="comment-option">
                                            @foreach($product->productComments as $productComment)
                                                <div class="co-item">
                                                    <div class="avatar-pic">
                                                        <img src="front/img/user/{{$productComment->users->avatar != null ? $productComment->users->avatar : "avatar.png"}}" alt="">
                                                    </div>
                                                    <div class="avatar-text">
                                                        <div class="at-rating">
                                                            @for($i=1 ; $i <= 5 ; $i++ )
                                                                @if($i <= $productComment->rating)
                                                                    <i class="fa fa-star"></i>
                                                                @else
                                                                    <i class="fa fa-star-o"></i>
                                                                @endif
                                                            @endfor
                                                        </div>
                                                        <h5>{{ $productComment->name }} <span>{{date('M d, Y',strtotime($productComment->created_at))}}</span></h5>
                                                        <div class="at-reply">{{ $productComment->messages }}</div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                        @if(\Illuminate\Support\Facades\Auth::check())
                                        <div class="leave-comment">
                                            <h4>Đánh giá của bạn</h4>
                                            <form action="" method="post" class="comment-form">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="personal-rating">
                                                            <div class="rate">
                                                                <input type="radio"  class="rating" id="star5" name="rating" value="5" />
                                                                <label for="star5" title="text">5 stars</label>
                                                                <input type="radio" class="rating" id="star4" name="rating" value="4" />
                                                                <label for="star4" title="text">4 stars</label>
                                                                <input type="radio" class="rating" id="star3" name="rating" value="3" />
                                                                <label for="star3" title="text">3 stars</label>
                                                                <input type="radio" class="rating" id="star2" name="rating" value="2" />
                                                                <label for="star2" title="text">2 stars</label>
                                                                <input type="radio" class="rating" id="star1" name="rating" value="1" />
                                                                <label for="star1" title="text">1 star</label>
                                                            </div>
                                                        </div>
                                                        <textarea placeholder="Nhập đánh giá...." name="messages"></textarea>
                                                    </div>
                                                </div>
                                            </form>
                                            <button class="site-btn cmt-btn">Đăng đánh giá</button>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Shop Section End -->

    <!-- Related Products Section End -->
    <div class="related-products spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2 >SẢN PHẨM TƯƠNG TỰ</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach($relatedProducts as $relatedProduct)
                    <div class="col-lg-3 col-sm-6">
                        <div class="product-item">
                            <div class="pi-pic">
                                <a href="shop/product/{{$relatedProduct->id}}"><img style="height: 300px" src="front/img/products/{{$relatedProduct->productImages[0]->path}}" alt=""></a>
                                @if($relatedProduct->discount != null)
                                    <div class="sale">Giảm giá</div>
                                @endif

                                <ul>
                                    @if(\Illuminate\Support\Facades\Auth::check())
                                    <li class="w-icon detail active"><a href="javascript:chooseCart({{$relatedProduct->id}})" title="Thêm vào giỏ hàng"><i class="icon_bag_alt"></i></a></li>
                                    @else
                                        <li class="w-icon detail active"><a href="account/login" title="Thêm vào giỏ hàng"><i class="icon_bag_alt"></i></a></li>
                                    @endif
                                    <li class="quick-view"><a href="shop/product/{{$relatedProduct->id}}" title="Chi tiết"><i class="fa fa-eye"></i> Chi tiết</a></li>
                                    @if(\Illuminate\Support\Facades\Auth::check())
                                        <li class="w-icon detail"><a href="javascript:chooseWishlist({{$relatedProduct->id}})" title="Thêm vào danh sách yêu thích"><i class="fa fa-heart-o"></i></a></li>
                                    @else
                                        <li class="w-icon detail"><a href="account/login" title="Thêm vào danh sách yêu thích"><i class="fa fa-heart-o"></i></a></li>
                                    @endif
                                </ul>
                            </div>
                            <div class="pi-text">
                                <div class="catagory-name">{{$relatedProduct->brands->name}}</div>
                                <a href="shop/product/{{$relatedProduct->id}}">
                                    <h6>{{$relatedProduct->name}}</h6>
                                </a>
                                <div class="product-price">
                                    @if($relatedProduct->discount != null)
                                        {{number_format($relatedProduct->discount, 0, ",", ".") }} VND
                                        <span>{{number_format($relatedProduct->price, 0, ",", ".")}} VND</span>
                                    @else
                                        {{number_format($relatedProduct->price, 0, ",", ".")}} VND
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach


            </div>
        </div>
    </div>
    <!-- Related Products Section End -->
        <script >
            function check(){
                var
            }
        </script>
@endsection
