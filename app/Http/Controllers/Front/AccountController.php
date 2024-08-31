<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\User\UserServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\URL;

class AccountController extends Controller
{
    private $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function login(Request $request)
    {
        $url = URL::previous();
        $login = URL::current();
        session(['login'=>$login]);
        session(['url'=>$url]);
        return view('front.account.login');
    }

    public function checkLogin(Request $request)
    {
        $active =[
            'email' => $request->email,
            'password' => $request->password,
            'level'=>2,
            'status' => 'active',
        ];
        $inactive = [
            'email' => $request->email,
            'password' => $request->password,
            'level'=>2,
            'status' => 'inactive',
        ];
        if (Auth::attempt($inactive)){
            return back()->with('notification','Lỗi: Hiện tại tài khoản không còn truy cập được! ');
        }elseif (Auth::attempt($active)){
            $url = session('url');
            if ($url == session('register') || $url == session('forgot') || $url == session('login')){
                return redirect()->intended('');
            }else{
                return redirect()->intended("$url");
            }
        }else{
            return back()->with('notification','Lỗi: Email hoặc mật khẩu không chính xác');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
    public function register()
    {
        return view('front.account.register');
    }

    public function insertUser(Request $request){
        $user = User::where('email',$request->email)->first();
        if ($user){
            return back()->with('notification','Lỗi: Email đã tồn tại');
        }
        if ($request->password != $request->confirm_password ){
            return back()->with('notification','Lỗi: Nhập lại mật khẩu không chính xác');
        }
        $data =[
            'name'=>$request->name,
            'email' => $request->email,
            'password'=> Hash::make("$request->password"),
            'level'=> 2,
        ];

        $this->userService->create($data);
        $url = URL::current();
        session(['register'=>$url]);
        return redirect('account/login')->with('notification','Đăng ký thành công! Vui lòng đăng nhập.');
    }
    public function forgotPass(){
        return view('front.account.forgotpass');
    }
    public function checkEmail(Request $request){
        if ($request->ajax()){
            $response['user'] = User::where('email',$request->email)->first();
            return $response;
        }
        return back();
    }
    public function resetPass(Request $request){
        if ($request->ajax()){
            if($request->password == $request->confirmPassword){
                $response['check'] = $this->userService->update(['password'=> Hash::make("$request->password")],$request->userId);
            }
            $response['user'] = $this->userService->find($request->userId);
            $url = URL::current();
            session(['forgot'=>$url]);
            return $response;
        }
        return back();
    }
}
