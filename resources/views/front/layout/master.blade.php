<!DOCTYPE html>
<html lang="zxx">

<head>
    <base href="{{asset('/')}}">
    <meta charset="UTF-8">
    <meta name="description" content="Fashi Template">
    <meta name="keywords" content="Fashi, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') | Meow Shop</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css?family=Muli:300,400,500,600,700,800,900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css">
    <link rel="stylesheet" href="front/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="front/css/font-awesome.min.css" type="text/css">
    <link rel="stylesheet" href="front/css/themify-icons.css" type="text/css">
    <link rel="stylesheet" href="front/css/elegant-icons.css" type="text/css">
    <link rel="stylesheet" href="front/css/owl.carousel.min.css" type="text/css">
    <link rel="stylesheet" href="front/css/nice-select.css" type="text/css">
    <link rel="stylesheet" href="front/css/jquery-ui.min.css" type="text/css">
    <link rel="stylesheet" href="front/css/slicknav.min.css" type="text/css">
    <link rel="stylesheet" href="front/css/style.css" type="text/css">
    <link rel="stylesheet" href="front/css/mycss.css" type="text/css">
</head>

<body>
    <!-- Header Section Begin -->
    <header class="header-section">
        <div class="header-top">
            <div class="container">
                <div class="ht-left">
                </div>
                <div class="ht-right">
                    @if(Auth::check())
                        <a href="./account/logout" class="login-panel"><i class="ti-power-off"></i> Đăng xuất</a>
                        <a title="Thông tin cá nhân" href="user" style="width:150px;" class="login-panel"><i class="fa fa-user"></i> {{Auth::user()->name}}</a>
                    @else
                        <div class="login-panel">
                            <i class="ti-power-off"></i>
                            <span>
                            <a href="./account/login" >Đăng nhập</a>
                                <span> / </span>
                            <a href="./account/register" >Đăng ký</a>
                            </span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="container">
            <div class="inner-header">
                <div class="row">
                    <div class="col-lg-3 col-md-3">
                        <div class="logo">
                            <a href="./index.html">
                                <img src="front/img/logoMS-1.png" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-7">
                        <form action="shop" method="get">
                            <div class="advanced-search">
                                <div class="input-group">
                                    <input name="search" {{request('search')}} type="text" placeholder="Nhập tên sản phẩm cần tìm...">
                                    <button  type="submit" title="Tìm kiếm"><i class="ti-search"></i></button>
                                </div>
                            </div>
                        </form>

                    </div>
                    <div class="col-lg-3 text-right col-md-3">
                        @if(Auth::check())
                            <ul class="nav-right">
                            <li class="heart-icon">
                                <a href="wishlist" title="Danh sách yêu thích">
                                    <i class="icon_heart_alt"></i>
                                    <span class="wl-count">{{count(\App\Models\Wishlist::where('user_id',\Illuminate\Support\Facades\Auth::id())->get())}}</span>
                                </a>
                            </li>
                            <li class="cart-icon">
                                <a href="cart" title="Giỏ hàng">
                                    <i class="icon_bag_alt"></i>
                                    <span class="cart-count">{{count(\App\Models\Cart::where('user_id',\Illuminate\Support\Facades\Auth::id())->get())}}</span>
                                </a>
                            </li>
                        </ul>
                        @else
                            <ul class="nav-right">
                                <li class="heart-icon">
                                    <a href="wishlist" title="Danh sách yêu thích">
                                        <i class="icon_heart_alt"></i>
                                        <span>0</span>
                                    </a>
                                </li>
                                <li class="cart-icon">
                                    <a href="cart" title="Giỏ hàng">
                                        <i class="icon_bag_alt"></i>
                                        <span>0</span>
                                    </a>
                                </li>
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="nav-item">
            <div class="container">
                <div class="nav-depart">
                    <div class="depart-btn">
                        <i class="ti-menu"></i>
                        <span>Danh mục sản phẩm</span>
                        <ul class="depart-hover">
                            @foreach(\App\Models\ProductCategory::limit(6)->orderBy('name')->get() as $cat)
                                <li><a href="shop/category/{{$cat->id}}">{{$cat->name}}</a></li>
                            @endforeach
                            <li><a href="shop">Xem thêm....</a></li>
                        </ul>
                    </div>
                </div>
                <nav class="nav-menu mobile-menu">
                    <ul>
                        <li class="{{(request()->segment(1)=='') ? 'active' : ''}}"><a href="./">Trang chủ</a></li>
                        <li class="{{(request()->segment(1)=='shop') ? 'active' : ''}}"><a href="./shop">Sản phẩm</a></li>
                        <li  ><a>Bộ sưu tập</a>
                            <ul class="dropdown">
                                <li><a href="shop/tag/nam">Thời trang nam</a></li>
                                <li><a href="shop/tag/nu">Thời trang nữ</a></li>
                                <li><a href="shop/tag/tre">Thời trang trẻ em</a></li>
                            </ul>
                        </li>
{{--                        <li><a href="./blog.html">Blog</a></li>--}}
                        <li class="{{(request()->segment(2)=='myOrder') ? 'active' : ''}}"><a href="order/myOrder">Đơn hàng</a></li>
                        <li class="{{(request()->segment(1)=='contact') ? 'active' : ''}}"><a href="contact">Liên hệ</a></li>

                    </ul>
                </nav>
                <div id="mobile-menu-wrap"></div>
            </div>
        </div>
    </header>
    <!-- Header End -->

    @yield('body')
    <div class="popup cart" id="detail">
        <div class="popup-content">
            <img src="" alt="" class="img_popup">
                <div class="show_detail">
                    <div class="show_item">
                        <input class="choose-id" name="product_id" type="hidden">
                        <h4 class="choose-name"></h4>
                    </div>
                    <div class="show_item">
                        <label style="width:30%">Màu sắc</label>
                        <select required class="color-choose" name="color" id="">

                        </select>
                    </div>
                    <div class="show_item">
                        <label style="width:30%">Kích thước</label>
                        <select required class="size-choose" name="size" id="">
                            <option value=""></option>
                        </select>
                    </div>
                    <div class="show_item">
                        <label style="width:30%">Số lượng</label>
                        <div class="product-details">
                            <div class="quantity">
                                <div style="border: 2px solid #ebebeb;" class="choose-qty">
                                    <input required type="text" class="qty-choose" value="1">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="show_item">
                        <a onclick="addCart()" title="Thêm vào giỏ hàng" class="btn btn-primary popup_btn"><i class="fa fa-cart-plus"></i> Thêm vào giỏ hàng</a>
                    </div>
                </div>
            <button class="btn btn-sm btn-outline-danger border-0 position-absolute btn-right btn-close" title="Đóng"><i class="fa fa-window-close"></i></button>
        </div>
    </div>
    <div class="popup wishlist" id="detail">
        <div class="popup-content">
            <img src="" alt="" class="img_popup">
            <div class="show_detail">
                <div class="show_item">
                    <input class="wl-choose-id" name="product_id" type="hidden">
                    <h4 class="choose-name"></h4>
                </div>
                <div class="show_item">
                    <label style="width:30%">Màu sắc</label>
                    <select required class="wl-color-choose" name="color" id="">

                    </select>
                </div>
                <div class="show_item">
                    <label style="width:30%">Kích thước</label>
                    <select required class="wl-size-choose" name="size" id="">
                    </select>
                </div>

                <div class="show_item">
                    <a onclick="addWishlist()" title="Thêm vào yêu thích" class="btn btn-primary popup_btn"><i class="fa fa-heart"></i> Thêm vào yêu thích</a>
                </div>
            </div>
            <button class="btn btn-sm btn-outline-danger border-0 position-absolute btn-right btn-close" title="Đóng"><i class="fa fa-window-close"></i></button>
        </div>
    </div>
    <footer style="border-top: 1px solid #ffd7f2; background-color: #da04d5;" class="footer-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="footer-left">
                        <div class="footer-logo">
                            <a><img src="front/img/logoMS-1.png" alt=""></a>
                        </div>
                        <ul>
                            <li>Email: thu197162@nuce.edu.vn</li>
                            <li>Số điện thoại: 0983604662</li>
                            <li>Địa chỉ: 55 Giải Phóng, Đồng Tâm, Hai Bà Trưng, Hà Nội, Việt Nam</li>
                        </ul>
                        <div class="footer-social">
                            <a><i class="fa fa-facebook"></i></a>
                            <a><i class="fa fa-instagram"></i></a>
                            <a><i class="fa fa-twitter"></i></a>
                            <a><i class="fa fa-pinterest"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1">

                </div>
                <div class="col-lg-8">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.7334696246867!2d105.84074577409933!3d21.00331848865413!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ac773026b415%3A0x499b8b613889f78a!2zVHLGsOG7nW5nIMSQ4bqhaSBI4buNYyBYw6J5IEThu7FuZyBIw6AgTuG7mWkgLSBIVUNF!5e0!3m2!1svi!2s!4v1670791897936!5m2!1svi!2s"
                        width="100%" height="90%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->
    <!-- Js Plugins -->
    <script src="front/js/jquery-3.3.1.min.js"></script>
    <script src="front/js/bootstrap.min.js"></script>
    <script src="front/js/jquery-ui.min.js"></script>
    <script src="front/js/popper.min.js"></script>
    <script src="front/js/jquery.countdown.min.js"></script>
    <script src="front/js/jquery.nice-select.min.js"></script>
    <script src="front/js/jquery.zoom.min.js"></script>
    <script src="front/js/jquery.dd.min.js"></script>
    <script src="front/js/jquery.slicknav.js"></script>
    <script src="front/js/owl.carousel.min.js"></script>
    <script src="front/js/owlcarousel2-filter.min.js"></script>
    <script src="front/js/main.js"></script>
    <script src="front/js/myscript.js"></script>
    <script src="./admin/js/my_script.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</body>

</html>
