<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\ProductDetail;
use App\Services\Cart\CartServiceInterface;
use App\Services\Product\ProductServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    private $productService;
    private $cartService;
    public function __construct(ProductServiceInterface $productService,CartServiceInterface $cartService)
    {
        $this->cartService = $cartService;
        $this->productService =$productService;
    }

    public function index(){
        if (Auth::check()){
            $carts = Cart::where('user_id',Auth::id())->orderBy('product_id')->get();
            $total = 0;
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
            return view('front.cart.index',compact('carts','total','delCarts','changeQty'));
        }else{
            return redirect('account/login');
        }
    }
    public function choose(Request $request){

        if($request->ajax()){
            $product = $this->productService->find($request->productId);
            $image_path = $product->productImages[0]->path;
            $response['id'] = $product->id;
            $response['name'] = $product->name;
            $response['img_path'] =$image_path;
            $response['color'] = ProductDetail::where('product_id',$request->productId)->distinct()->get(['color']);
            $response['size'] = ProductDetail::where('product_id',$request->productId)->distinct()->get(['size']);
            return $response;
        }
        return back();
    }
    public function addToCartProduct(Request $request){
        if ($request->ajax()){
            $product = $this->productService->find($request->productID);
            $pro_cart = Cart::where('user_id',Auth::id())->where('product_id',$product->id)->first();
            $check = ProductDetail::where('product_id',$product->id)->where('color',$request->color)->where('size',$request->size)->first();
            if($check->qty > 0 && $check->qty > $request->qty){
                if($pro_cart && $pro_cart->color == $request->color && $pro_cart->size == $request->size){
                    $response['qty'] = $pro_cart->qty + $request->qty;
                    $response['cart'] = $this->cartService->update(['qty'=> $response['qty']],$pro_cart->id);
                }else{
                    $response['cart']= $this->cartService->create([
                        'product_id'=>$product->id,
                        'user_id'=>Auth::id(),
                        'color'=>$request->color,
                        'size'=>$request->size,
                        'qty'=>$request->qty
                    ]);
                }
            }
            $response['checkQTY'] = $check->qty;
            $response['count'] = count(Cart::where('user_id', Auth::id())->get());
            return $response;
        }
        return back();
    }
    public function addToCart(Request $request){
        if ($request->ajax()){
            $product = $this->productService->find($request->productID);
            $pro_cart = Cart::where('user_id',Auth::id())->where('product_id',$product->id)->first();
            $check = ProductDetail::where('product_id',$product->id)->where('color',$request->color)->where('size',$request->size)->first();
            if($check->qty > 0 && $check->qty > $request->qty){
                if($pro_cart && $pro_cart->color == $request->color && $pro_cart->size == $request->size){
                    $response['qty'] = $pro_cart->qty + $request->qty;
                    $response['cart'] = $this->cartService->update(['qty'=> $response['qty']],$pro_cart->id);
                    $response['cart_id']=$pro_cart->id;
                    $response['cart_qty'] = $pro_cart->qty;
                }else{
                    $response['cart']= $this->cartService->create([
                        'product_id'=>$product->id,
                        'user_id'=>Auth::id(),
                        'color'=>$request->color,
                        'size'=>$request->size,
                        'qty'=>$request->qty
                    ]);
                    $response['cart_id'] = $response['cart']->id;
                }
            }
            $response['checkQTY'] = $check->qty;
            if($product->discount != null){
                $response['price'] = $product->discount;
            }else{
                $response['price'] = $product->price;
            }
            $response['count'] = count(Cart::where('user_id', Auth::id())->get());
            $response['name'] = $product->name;
            $image_path = $product->productImages[0]->path;
            $response['img_path'] =$image_path;
            return $response;
        }
        return back();
    }
    public function delete(Request $request){
        if ($request->ajax()){
            $response['cart'] = $this->cartService->delete($request->cartId);
            $carts = Cart::where('user_id',Auth::id())->get();
            $response['count'] = count($carts);
            $total = 0;
            foreach ($carts as $cart){
                if($cart->products->discount != null){
                    $total += $cart->qty * $cart->products->discount;
                }else{
                    $total += $cart->qty * $cart->products->price;
                }
                $response['total'] = number_format($total, 0, ",", ".") ;
            }
            return $response;
        }
        return back();
    }
    public function destroy(){
        $carts = Cart::where('user_id',Auth::id())->get();
        foreach ($carts as $cart){
            $cart->delete();
        }
    }
    public function updateQTY(Request $request){
        if ($request->ajax()){
            $pro_cart = Cart::where('user_id',Auth::id())->where('id',$request->cartId)->first();
            $product = $this->productService->find($pro_cart->product_id);
            if($request->qty == 0){
                $response['cart'] = $this->cartService->delete($request->cartId);
            }else{
                $response['cart'] = $this->cartService->update(['qty'=> $request->qty],$pro_cart->id);
            }
            $carts = Cart::where('user_id',Auth::id())->get();
            $total = 0;
            foreach ($carts as $cart){
                if($cart->products->discount != null){
                    $total += $cart->qty * $cart->products->discount;
                }else{
                    $total += $cart->qty * $cart->products->price;
                }
                $response['total'] = number_format($total, 0, ",", ".") ;
            }
            $response['count'] = count(Cart::where('user_id', Auth::id())->get());
            if($product->discount != null){
                $response['price'] = number_format($product->discount * $request->qty, 0, ",", ".") ;
            }else{
                $response['price'] =  number_format($product->price * $request->qty, 0, ",", ".");
            }
            return $response;
        }
        return back();
    }
    public function updateColor(Request $request){
        if ($request->ajax()){
            $pro_cart = Cart::where('user_id',Auth::id())->where('id',$request->cartId)->first();
            $response['cart'] = $this->cartService->update(['color'=> $request->color ],$pro_cart->id);
            return $response;
        }
        return back();
    }
    public function updateSize(Request $request){
        if ($request->ajax()){
            $pro_cart = Cart::where('user_id',Auth::id())->where('id',$request->cartId)->first();
            $response['cart'] = $this->cartService->update(['size'=> $request->size ],$pro_cart->id);
            return $response;
        }
        return back();
    }
}
