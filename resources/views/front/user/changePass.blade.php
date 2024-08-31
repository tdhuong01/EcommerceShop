
@extends("front.layout.master")

@section('title','Thay đổi mật khẩu')

@section('body')

    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="#"><i class="fa fa-home"></i> Trang chủ</a>
                        <a href="user"><i class="fa fa-user"></i> Thông tin cá nhân</a>
                        <span>Thay đổi mật khẩu</span>
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
                            <form action="" method="post">
                                @csrf
                                <ul class="pro-input-label">
                                    <li>
                                        <label>Mật khẩu hiện tại </label>
                                        <input type="password" name="password" required placeholder="Nhập mật khẩu hiện tại" >
                                    </li>
                                </ul>
                                <ul class="pro-input-label">
                                    <li>
                                        <label>Mật khẩu mới</label>
                                        <input type="password" name="newpass" required placeholder="Nhập mật khẩu mới">
                                    </li>
                                </ul>
                                <ul class="pro-input-label">
                                    <li>
                                        <label>Xác nhận mật khẩu mới</label>
                                        <input type="password" name="confirmpass" required placeholder="Xác nhận mật khẩu mới">
                                    </li>
                                </ul>
                                <ul class="pro-submit">
                                    <li>
                                        <button type="submit" class="btn btn-warning">Change Password</button>
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
