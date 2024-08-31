<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Wishlist;
use App\Services\Cart\CartServiceInterface;
use App\Services\Product\ProductServiceInterface;
use App\Services\Wishlist\WishlistServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    private $productService;
    private $wishlistService;
    private $cartService;
    public function __construct(ProductServiceInterface $productService,WishlistServiceInterface $wishlistService,CartServiceInterface $cartService)
    {
        $this->wishlistService = $wishlistService;
        $this->productService =$productService;
        $this->cartService = $cartService;
    }
    public function index(){
        if (Auth::check()){
            $wishlists = Wishlist::where('user_id',Auth::id())->get();
            return view('front.wishlist.index',compact('wishlists'));
        }else{
            return redirect('account/login');
        }
    }
    public function choose(Request $request){

        if($request->ajax()){
            $product = Product::where('id',$request->productId)->first();
            $image_path = $product->productImages[0]->path;
            $response['id'] = $product->id;
            $response['name'] = $product->name;
            $response['img_path'] =$image_path;
            $response['color'] = $product->productDetails;
            return $response;
        }
        return back();
    }
    public function addCartWl(Request $request){
        if ($request->ajax()){
            $wl = $this->wishlistService->find($request->wlId);

            $pro_cart = Cart::where('user_id',Auth::id())->where('product_id',$wl->products->id)->first();
            if($pro_cart && $pro_cart->color == $wl->color && $pro_cart->size == $wl->size){
                $response['qty'] = $pro_cart->qty + 1;
                $response['cart'] = $this->cartService->update(['qty'=> $response['qty']],$pro_cart->id);
            }else{
                $response['cart']= $this->cartService->create([
                    'product_id'=>$wl->products->id,
                    'user_id'=>Auth::id(),
                    'color'=>$wl->color != ''?$wl->color:'black',
                    'size'=>$wl->size != ''?$wl->size:'S',
                    'qty'=>1
                ]);
                $response['cart_id'] = $response['cart']->id;
            }
            $response['count_cart'] = count(Cart::where('user_id', Auth::id())->get());
            $this->wishlistService->delete($request->wlId);
            $response['countWl'] = count(Wishlist::where('user_id', Auth::id())->get());
            return $response;
        }
        return back();
    }
    public function addToWishlist(Request $request){
        if ($request->ajax()){
            $pro_cart = Wishlist::where('user_id',Auth::id())->where('product_id',$request->productId)->first();
            $response['check'] = true;
            if($pro_cart && $pro_cart->color == $request->color && $pro_cart->size == $request->size){
                $response['check'] = false;
            }else{
                $response['cart']=$this->wishlistService->create([
                    'product_id'=>$request->productId,
                    'user_id'=>Auth::id(),
                    'color'=>$request->color != ''?$request->color:'black',
                    'size'=>$request->size != ''?$request->size:'S'
                ]);
            }
            $response['count'] = count(Wishlist::where('user_id', Auth::id())->get());
            return $response;
        }
        return back();
    }
    public function updateColor(Request $request){
        if ($request->ajax()){
            $pro_wl = Wishlist::where('user_id',Auth::id())->where('id',$request->wlId)->first();
            $response['cart'] = $this->wishlistService->update(['color'=> $request->color ],$pro_wl->id);
            return $response;
        }
        return back();
    }
    public function updateSize(Request $request){
        if ($request->ajax()){
            $pro_wl = Wishlist::where('user_id',Auth::id())->where('id',$request->wlId)->first();
            $response['cart'] = $this->wishlistService->update(['size'=> $request->size ],$pro_wl->id);
            return $response;
        }
        return back();
    }
    public function delete(Request $request){
        if ($request->ajax()){
            $response['wl'] = $this->wishlistService->delete($request->wlId);
            $response['count'] = count(Wishlist::where('user_id', Auth::id())->get());
            return $response;
        }
        return back();
    }
    public function destroy(){
        $carts = Wishlist::where('user_id',Auth::id())->get();
        foreach ($carts as $cart){
            $cart->delete();
        }
    }
}
