<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\User;
use App\Services\Cart\CartServiceInterface;
use App\Services\Order\OrderServiceInterface;
use App\Services\OrderDetail\OrderDetailServiceInterface;
use App\Services\ProductDetail\ProductDetailServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    private $orderService;
    private $orderDetailService;
    private $productDetailService;
    public function __construct(OrderServiceInterface $orderService,OrderDetailServiceInterface $orderDetailService,
                                ProductDetailServiceInterface $productDetailService)
    {
       $this->orderService = $orderService;
       $this->orderDetailService = $orderDetailService;
       $this->productDetailService = $productDetailService;
    }

    public function checkout(){
        $user = User::where('id',Auth::id())->first();
        //Tìm giỏ hàng
        $carts = Cart::where('user_id',Auth::id())->get();
        $total = 0;
        //kiem tra san pham
        $delCarts = array();
        $changeQty = array();
        foreach ($carts as $cart){
            $check = ProductDetail::where('product_id',$cart->product_id)->where('color',$cart->color)->where('size',$cart->size)->first();
            if($check->qty == 0){
                $name =$cart->products->name;
                $delCarts[] = "$name($cart->color,$cart->size)";
            }elseif ($check->qty > 0 && $cart->qty > $check->qty ){
                $name =$cart->products->name;
                $changeQty[] = "$name($cart->color,$cart->size)";
            }
            if($cart->products->discount != null){
                $total += $cart->qty * $cart->products->discount;
            }else{
                $total += $cart->qty * $cart->products->price;
            }
        }
        if($delCarts == null && $changeQty == null){
            return view('front.order.index',compact('carts','total','user'));
        }else{
            return back();
        }

    }

    public function addOrder(Request $request){
        $carts = Cart::where('user_id',Auth::id())->get();
        //Thêm đơn hàng
        $data_order = $request->all();
        $data_order['total'] =0;
        foreach ($carts as $cart){
            $data_order['total'] += $cart->products->discount !=null ?
                $cart->products->discount * $cart->qty:$cart->products->price * $cart->qty;
        }
        $data_order['user_id'] = Auth::id();
        $order = $this->orderService->create($data_order);
        // Thêm chi tiết đơn hàng
        foreach ($carts as $cart){
            $data =[
                'order_id'=>$order->id,
                'product_id'=>$cart->product_id,
                'color'=>$cart->color,
                'size'=>$cart->size,
                'qty'=>$cart->qty,
                'amount'=>$cart->products->discount !=null ? $cart->products->discount:$cart->products->price,
                'total'=>$cart->products->discount !=null ? $cart->products->discount * $cart->qty:$cart->products->price * $cart->qty
            ];
            $this->orderDetailService->create($data);
        }

        //Cập nhật số lượng sản phẩm
        foreach ($carts as $cart){
            $product = ProductDetail::where('product_id',$cart->product_id)
                ->where('color',$cart->color)->where('size',$cart->size)->first();
            $qty = $product->qty - $cart->qty;
            $this->productDetailService->update(['qty'=>$qty],$product->id);
            $this->updateQty($cart->product_id);
        }
        //Xóa giỏ hàng
        foreach ($carts as $cart){
            $cart->delete();
        }
        //Thông báo kết quả
        return redirect('/order/myOrder');
    }
    public function orderHistory(){
        if(Auth::check()){
            $orders = Order::where('user_id',Auth::id())->orderByDesc('created_at')->get();
            return view('front.order.orderHistory',compact('orders'));
        }else{
            return redirect('account/login');
        }
    }
    public function orderDetail($id){
       $orders = OrderDetail::where('order_id',$id)->get();
        return view('front.order.orderDetail',compact('orders'));
    }
    public function submitOrder($orderId){
        $order = $this->orderService->find($orderId);
        $this->orderService->update(['status'=>'Đã nhận hàng'],$order->id);
        return back();
    }
    public function cancelOrder($orderId){
        $order = $this->orderService->find($orderId);
        $this->orderService->update(['status'=>'Đơn hàng bị hủy'],$order->id);
        return back();
    }
    private function sendMail($order, $total){

    }
    public function updateQty($product_id){
        $product = Product::find($product_id);
        $productDetail = $product->productDetails;
        $totalQty = array_sum(array_column($productDetail->toArray(),'qty'));
        $product->update(['qty'=>$totalQty]);
    }
}
