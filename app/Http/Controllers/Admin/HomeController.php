<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\ProductImage;
use App\Services\Order\OrderServiceInterface;
use App\Services\Product\ProductServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    private $productService;
    public function __construct(ProductServiceInterface $productService)
    {
        $this->productService = $productService;
    }
    public function index(){
        $orders = Order::all();
        $product = $this->productService->all();
        $total = 0;
        $orderSubmits = Order::where('status','Đã nhận hàng')->get();
        foreach ($orderSubmits as $order){
            $total +=$order->total;
        }
        $pendingOrders = Order::where('status',"Chờ xử lý")->get();
        return view('admin.index',compact('orders','product','total','pendingOrders'));
    }
    public function login()
    {
        return view('admin.login');
    }

    public function checkLogin(Request $request)
    {
        $admin =[
            'email' => $request->email,
            'password' => $request->password,
            'level'=>1,
        ];
        if (Auth::attempt($admin)){
            return redirect()->intended('admin/dashboard');
        }else{
            return back()->with('notification','Lỗi: Email hoặc mật khẩu không chính xác');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/admin/login');
    }
    public function submitCreatePro(){
        session()->forget('create_pro');
        return redirect('admin/product');
    }

    public function checkImg($id){
        $product = ProductImage::where('product_id',$id)->first();
        if ($product){
            return redirect('admin/product/'.$id.'/detail/create');
        } else{
            return back()->with('notification','Lỗi: Chưa có hình ảnh sản phẩm! Hãy thêm hình ảnh sản phẩm.');
        }
    }

}
