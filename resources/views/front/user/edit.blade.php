
@extends("front.layout.master")

@section('title','Sửa thông tin cá nhân')

@section('body')

    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="#"><i class="fa fa-home"></i> Trang chủ</a>
                        <a href="user"><i class="fa fa-user"></i> Thông tin cá nhân</a>
                        <span>Sửa thông tin cá nhân</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Section Begin -->

    <!-- Product Shop Section Begin -->
    <section class="order-histry-area section-tb-padding">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="order-history">
                        <div class="profile">
                            <div class="order-pro">
                                <div class="pro-img" style="width: 50%";>
                                    <form method="post" action="user/avatar" enctype="multipart/form-data">
                                        @csrf
                                        <div style="overflow: hidden;">
                                            <img style="display: inline;width: 100% ;border-style: none;object-fit: fill;cursor: pointer;"
                                                 class="img-fluid thumbnail"
                                                 data-toggle="tooltip" title="Nhấn để thay đổi ảnh đại diện" data-placement="bottom"
                                                 src="front/img/user/{{$user->avatar != null ? $user->avatar : "avatar.png"}}" alt="Add Image">

                                            <input name="image" type="file" onchange="changeImg(this); this.form.submit();"
                                                   accept="image/x-png,image/gif,image/jpeg"
                                                   class="add_image form-control-file" style="display: none;">

                                            <input type="hidden" name="product_id" value="">
                                        </div>
                                    </form>
                                </div>
                                <div class="order-name">
                                    <h4>{{$user->name}}</h4>
                                </div>
                            </div>
                            <div class="order-his-page">
                                <ul class="profile-ul">
                                    <li class="profile-li"><a  class="{{(request()->segment(2)=='edit') ? 'active' : ''}}" href="user/edit">Sửa thông tin cá nhân</a></li>
                                    <li class="profile-li"><a  class="{{(request()->segment(2)=='changePass') ? 'active' : ''}}" href="user/changePass">Thay đổi mật khẩu</a></li>
                                    <li class="profile-li"><a href="account/logout">Đăng xuất</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="profile-form">
                            @if(session('notification'))
                                <div class="alert alert-warning" role="alert">
                                    {{session('notification')}}
                                </div>
                            @endif
                            <form action="user/edit" method="post">
                                @csrf
                                <ul class="pro-input-label">
                                    <li>
                                        <label>Họ tên</label>
                                        <input type="text"  name="name" required placeholder="Nhập họ tên khách hàng" value="{{$user->name}}">
                                    </li>
                                    <li>
                                        <label>Số điện thoại</label>
                                        <input type="text" name="phone" required value="{{$user->phone}}" placeholder="Nhập số điện thoại">
                                    </li>
                                </ul>
                                <ul class="pro-input-label">
                                    <li style="width: 100%;">
                                        <label>Địa chỉ</label>
                                        <input type="text" value="{{$user->address}}" required name="address" placeholder="Nhập địa chỉ">
                                    </li>
                                </ul>
                                <ul class="pro-input-label">
                                    <li>
                                        <label>Thành phố</label>
                                        <input type="text" value="{{$user->city}}" required name="city" placeholder="Nhập thành phố" >
                                    </li>
                                    <li>
                                        <label>Quốc gia</label>
                                        <input type="text" name="country" value="{{$user->country}}" required placeholder="Nhập quốc gia">
                                    </li>
                                </ul>
                                <ul class="pro-submit">
                                    <li>
                                        <label style="width: 100%;margin-right: 10px;">Mật khẩu hiện tại:</label>
                                        <input style="width: 150%;border: 1px solid #eee;border-radius: 5px;padding: 10px 15px;" type="password" name="password" required placeholder="Nhập mật khẩu hiện tại">
                                    </li>
                                    <li>
                                        <button type="submit" class="btn btn-warning">Cập nhật</button>
                                    </li>
                                </ul>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Shop Section End -->

@endsection
