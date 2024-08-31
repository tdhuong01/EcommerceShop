
@extends("front.layout.master")

@section('title','Danh sách yêu thích')

@section('body')
    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text product-more">
                        <a href=""><i class="fa fa-home"></i> Trang chủ</a>
                        <span>Danh sách yêu thích</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->

    <!-- Shopping Cart Section Begin -->
    <section class="shopping-cart spad">
        <div class="container">
            <div class="row">
                @if(count($wishlists) >0)
                    <div class="col-lg-12">
                        <div class="wl-tb cart-table">
                            <table>
                                <thead>
                                <tr>
                                    <th>Hình ảnh</th>
                                    <th>Tên sản phẩm</th>
                                    <th>Màu sắc</th>
                                    <th>Kích thước</th>
                                    <th>Đơn giá</th>
                                    <th><i title="Thêm vào giỏ hàng" class="ti-shopping-cart"></i></th>
                                    <th><i title="Xóa toàn bộ" onclick="destroyWl()" class="ti-trash"></i></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($wishlists as $wishlist)
                                    <tr data-id="{{$wishlist->id}}">
                                        <td style="width: 150px;height: 150px; padding: 10px 10px;" class="cart-pic first-row"><img src="front/img/products/{{$wishlist->products->productImages[0]->path}}" alt=""></td>
                                        <td class="first-row">
                                            <input type="hidden" value="{{$wishlist->products->id}}">
                                            <h5>{{$wishlist->products->name}}</h5>
                                        </td>
                                        <td class="qua-col first-row wl-color">
                                            <select style="border: 1px solid; border-radius: 4px;" name="color" data-id="{{$wishlist->id}}">
                                                @foreach(array_unique(array_column($wishlist->products->productDetails->toArray(),'color')) as $productColor )
                                                    <option {{$wishlist->color == $productColor ? 'selected' : ''}} value="{{$productColor}}">{{$productColor}}</option>
                                                @endforeach

                                            </select>
                                        </td>
                                        <td class="qua-col first-row wl-size">
                                            <select style="border: 1px solid; border-radius: 4px;" name="size" data-id="{{$wishlist->id}}">
                                                @foreach(array_unique(array_column($wishlist->products->productDetails->toArray(),'size')) as $productSize )
                                                    <option {{$wishlist->size == $productSize ? 'selected' : ''}} value="{{$productSize}}">{{$productSize}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td class="p-price first-row">{{$wishlist->products->discount != null ? number_format($wishlist->products->discount, 0, ",", "."):number_format($wishlist->products->price, 0, ",", ".")}}  VND</td>
                                        <td class="close-td first-row"><a class="btn btn-primary" onclick="addCartWl('{{$wishlist->id}}')"><i class="ti-shopping-cart"></i></a></td>
                                        <td class="close-td first-row"><a class="btn btn-danger" onclick="deleteWl('{{$wishlist->id}}')"><i class="ti-trash"></i></a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                        </div>
{{--                        <div class="row col-12">--}}
{{--                            <div class="cart-buttons">--}}
{{--                                <a href="#" class="primary-btn continue-shop">Continue shopping</a>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </div>
                @else
                    <div class="col-lg-12" style="text-align: center">
                        <h3>Danh sách yêu thích đang trống</h3>
                        <br>
                        <a href="/shop" class="btn btn-primary"><h5>Quay lại trang sản phẩm</h5></a>
                    </div>
                @endif
            </div>
        </div>
    </section>
    <!-- Shopping Cart Section End -->
@endsection
