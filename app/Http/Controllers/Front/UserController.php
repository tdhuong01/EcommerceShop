<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\ProductImage;
use App\Services\User\UserServiceInterface;
use App\Utilities\Common;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private $userService;
    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    public function index(){
        $user = Auth::user();
        return view('front.user.index',compact('user'));
    }
    public function edit(){
        $user = Auth::user();
        return view('front.user.edit',compact('user'));
    }
    public function update(Request $request){
        if(Hash::check($request->password,Auth::user()->password)){
            $data = [
                'name'=>$request->name,
                'phone' => $request->phone,
                'address' => $request->address,
                'city' => $request->city,
                'country' => $request->country
            ];
            $this->userService->update($data,Auth::id());
            return redirect('user');
        }else{
            return back()->with('notification','Lỗi: Mật khẩu cũ không chính xác');
        }
    }
    public function changePass(){
        $user = Auth::user();
        return view('front.user.changePass',compact('user'));
    }
    public function checkPass(Request $request){
        if(Hash::check($request->password,Auth::user()->password)){
            if($request->newpass == $request->confirmpass){
                $this->userService->update(['password'=>Hash::make("$request->newpass")],Auth::id());
                return redirect('user');
            }else{
                return back()->with('notification','Lỗi: Xác nhận mật khẩu không giống nhau');
            }
        }else{
            return back()->with('notification','Lỗi: Mật khẩu cũ không chính xác');
        }
    }
    public function updateAvatar(Request $request){
        if($request->hasFile('image')){
            $avatar = Common::uploadFile($request->file('image'),'front/img/user');
            $this->userService->update(['avatar'=>$avatar],Auth::id());
        }
        return redirect('user');
    }
}
