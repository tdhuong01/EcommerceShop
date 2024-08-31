@extends("front.layout.master")

@section('title','Quên mật khẩu')

@section('body')
    <!-- Breadcrumb Section Begin -->
    <div class="breacrumb-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-text">
                        <a href="#"><i class="fa fa-home"></i> Trang chủ</a>
                        <a href="account/login">Đăng nhập</a>
                        <span>Quên mật khẩu</span>
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
                    <div class="login-form">
                        <h2>Quên mật khẩu</h2>
                        <div class="forgot-warning" role="alert"></div>
                        <form class="form-forgot">
                            <div class="group-input">
                                <label for="email">Email (<span style="color: red">*</span>)</label>
                                <input type="email" id="email" class="email_forgot" placeholder="Nhập email của bạn...">
                            </div>
                            <a onclick="checkEmail()" class="btn btn-warning login-btn forgot-btn"><i class="ti-lock"></i> Quên mật khẩu</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function checkEmail(email){
            email = $('.email_forgot').val();
            $.ajax({
                type:'get',
                url: 'account/checkEmail',
                data:{email:email},
                success: function (response){
                    if(response['user']){
                        var form =$('.form-forgot');
                        form.children().remove();
                        $('.forgot-warning').text("").removeClass("alert alert-warning");
                        var newItem =
                            '<input class="userId" type="hidden" value="'+response['user'].id+'"  name="user_id">\n'+
                            '<div class="group-input">\n'+
                            '<label>Mật khẩu mới (<span style="color: red">*</span>)</label>\n'+
                            '<input type="password" class="pass" required placeholder="Nhập mật khẩu mới">\n'+
                            '</div>\n'+
                            '<div class="group-input">\n'+
                            '<label>Xác nhận mật khẩu mới(<span style="color: red">*</span>)</label>\n'+
                            '<input type="password"  class="confirmPass" required placeholder="Xác nhận mật khẩu mới">\n'+
                            '</div>\n'+
                            '<a onclick="resetPass()" class="btn btn-warning login-btn forgot-btn"><i class="ti-lock"></i> Thay đổi mật khẩu</button>';
                        form.append(newItem);
                    }else{
                        $('.forgot-warning').text("Email không chính xác! Vui lòng nhập lại.").addClass("alert alert-warning");
                    }
                } ,
                error: function (response) {
                },
            });

        }
        function resetPass(userId,password,confirmPassword){
            userId = $('.userId').val();
            password = $('.pass').val();
            confirmPassword = $('.confirmPass').val();
            $.ajax({
                type:'get',
                url: 'account/resetPass',
                data:{userId:userId,password:password,confirmPassword:confirmPassword},
                success: function (response){
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Thay đổi mật khẩu thành công',
                        text: 'Thay đổi mật khẩu thành công cho tài khoản '+response['user'].name,
                        showConfirmButton: false,
                        timer: 800
                    });
                    setTimeout(function (){
                        location.replace('/account/login');
                    },800);
                },
                error: function (response) {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Thay đổi mật khẩu thất bại',
                        text: 'Thay đổi mật khẩu thất bại cho tài khoản '+response['user'].name,
                        showConfirmButton: false,
                        timer: 800
                    })
                },
            });

        }
    </script>
    <!-- Register Form Section End -->
@endsection
