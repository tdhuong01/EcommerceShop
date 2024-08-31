<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Services\Order\OrderServiceInterface;

class OrderController extends Controller
{
    private $orderService;
    public function __construct(OrderServiceInterface $orderService)
    {
        $this->orderService = $orderService;
    }
    public function index(){
        $orders = Order::orderByDesc('created_at')->get();
        return view('admin.order.index',compact('orders'));
    }
    public function submitOrder($id){
        $this->orderService->update(['status'=>'Đang giao hàng'],$id);
        return back();
    }
    public function cancelOrder($id){
        $this->orderService->update(['status'=>'Đơn hàng bị hủy bởi người bán'],$id);
        return back();
    }
    public function orderDetail($id){
        $orders = OrderDetail::where('order_id',$id)->get();
        return view('admin.order.orderDetail',compact('orders'));
    }
}
