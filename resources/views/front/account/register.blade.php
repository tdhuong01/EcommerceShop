@extends("front.layout.master")

@section('title','Đăng ký')

@section('body')

    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="#"><i class="fa fa-home"></i> Trang chủ</a>
                        <span>Đăng ký</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Breadcrumb Form Section Begin -->

    <!-- Register Section Begin -->
    <div class="register-login-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="register-form">
                        <h2>Đăng ký</h2>
                        @if(session('notification'))
                            <div class="alert alert-warning" role="alert">
                                {{session('notification')}}
                            </div>
                        @endif
                        <form action="" method="post">
                            @csrf
                            <div class="group-input">
                                <label for="username">Họ tên (<span style="color: red">*</span>)</label>
                                <input type="text" required id="name" name="name">
                            </div>
                            <div class="group-input">
                                <label for="username">Email (<span style="color: red">*</span>)</label>
                                <input type="email" required id="email" name="email">
                            </div>
                            <div class="group-input">
                                <label for="pass">Mật khẩu (<span style="color: red">*</span>)</label>
                                <input type="password" required id="pass" name="password">
                            </div>
                            <div class="group-input">
                                <label for="con-pass">Nhập lại mật khẩu (<span style="color: red">*</span>)</label>
                                <input type="password" required id="con-pass" name="confirm_password">
                            </div>
                            <button type="submit" class="site-btn register-btn">Đăng ký</button>
                        </form>
                        <div class="switch-login">
                            <a href="./account/login" class="or-login">Hoặc đăng nhập</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Register Form Section End -->

@endsection
