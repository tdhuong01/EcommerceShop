<?php

use App\Http\Middleware\CheckMemberLogin;
use App\Http\Middleware\CheckAdminLogin;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [App\Http\Controllers\Front\HomeController::class,'index']);
Route::get('contact', [App\Http\Controllers\Front\HomeController::class,'contact']);

Route::prefix('shop')->group(function (){
    Route::get('product/{id}',[App\Http\Controllers\Front\ShopController::class,'show']);
    Route::post('product/{id}',[App\Http\Controllers\Front\ShopController::class,'postComment']);
    Route::get('',[App\Http\Controllers\Front\ShopController::class,'index']);
    Route::get('category/{id}',[App\Http\Controllers\Front\ShopController::class,'category']);
    Route::get('tag/{tag}',[App\Http\Controllers\Front\ShopController::class,'tag']);
});
Route::prefix('account')->group(function (){
    //login
    Route::get('login',[\App\Http\Controllers\Front\AccountController::class,'login']);
    Route::post('login',[\App\Http\Controllers\Front\AccountController::class,'checkLogin']);
    //logout
    Route::get('logout',[\App\Http\Controllers\Front\AccountController::class,'logout']);
    //register
    Route::get('register',[\App\Http\Controllers\Front\AccountController::class,'register']);
    Route::post('register',[\App\Http\Controllers\Front\AccountController::class,'insertUser']);
    //forgot
    Route::get('forgotPass',[\App\Http\Controllers\Front\AccountController::class,'forgotPass']);
    Route::get('checkEmail',[\App\Http\Controllers\Front\AccountController::class,'checkEmail']);
    Route::get('resetPass',[\App\Http\Controllers\Front\AccountController::class,'resetPass']);
});

//admin
Route::prefix('admin')->middleware('CheckAdminLogin')->group( function (){
    Route::get('dashboard',[\App\Http\Controllers\Admin\HomeController::class,'index']);
    Route::prefix('login')->group(function (){
        Route::get('',[\App\Http\Controllers\Admin\HomeController::class,'login'])->withoutMiddleware('CheckAdminLogin');
        Route::post('',[\App\Http\Controllers\Admin\HomeController::class,'checkLogin'])->withoutMiddleware('CheckAdminLogin');
    });
    Route::get('logout',[\App\Http\Controllers\Admin\HomeController::class,'logout']);
    Route::resource('user',\App\Http\Controllers\Admin\UserController::class);
    Route::resource('category',\App\Http\Controllers\Admin\CategoryController::class);
    Route::resource('brand',\App\Http\Controllers\Admin\BrandController::class);
    Route::resource('product',\App\Http\Controllers\Admin\ProductController::class);
    Route::resource('product/{product_id}/image',\App\Http\Controllers\Admin\ProductImagesController::class);
    Route::resource('product/{product_id}/detail',\App\Http\Controllers\Admin\ProductDetailsController::class);
    Route::get('submitCreate',[\App\Http\Controllers\Admin\HomeController::class,'submitCreatePro']);
    Route::get('checkImg/{id}',[\App\Http\Controllers\Admin\HomeController::class,'checkImg']);
    Route::prefix('order')->group( function (){
        Route::get('',[\App\Http\Controllers\Admin\OrderController::class,'index']);
        Route::get('orderDetail/{id}',[\App\Http\Controllers\Admin\OrderController::class,'orderDetail']);
        Route::get('submit/{id}',[\App\Http\Controllers\Admin\OrderController::class,'submitOrder']);
        Route::get('cancel/{id}',[\App\Http\Controllers\Admin\OrderController::class,'cancelOrder']);
    });
});
//user
Route::prefix('user')->middleware('CheckMemberLogin')->group(function (){
    Route::get('',[\App\Http\Controllers\Front\UserController::class,'index']);
    Route::get('edit',[\App\Http\Controllers\Front\UserController::class,'edit']);
    Route::get('changePass',[\App\Http\Controllers\Front\UserController::class,'changePass']);
    Route::post('edit',[\App\Http\Controllers\Front\UserController::class,'update']);
    Route::post('changePass',[\App\Http\Controllers\Front\UserController::class,'checkPass']);
    Route::post('avatar',[\App\Http\Controllers\Front\UserController::class,'updateAvatar']);
});
//cart
Route::prefix('cart')->middleware('CheckMemberLogin')->group( function (){
    Route::get('',[\App\Http\Controllers\Front\CartController::class,'index']);
    Route::get('choose',[\App\Http\Controllers\Front\CartController::class,'choose']);
    Route::get('add',[\App\Http\Controllers\Front\CartController::class,'addToCart']);
    Route::get('updateQty',[\App\Http\Controllers\Front\CartController::class,'updateQTY']);
    Route::get('updateColor',[\App\Http\Controllers\Front\CartController::class,'updateColor']);
    Route::get('updateSize',[\App\Http\Controllers\Front\CartController::class,'updateSize']);
    Route::get('delete',[\App\Http\Controllers\Front\CartController::class,'delete']);
    Route::get('destroy',[\App\Http\Controllers\Front\CartController::class,'destroy']);
    Route::get('addCartPro',[\App\Http\Controllers\Front\CartController::class,'addToCartProduct'])->withoutMiddleware('CheckMemberLogin');
});
Route::prefix('wishlist')->middleware('CheckMemberLogin')->group(function (){
    Route::get('',[\App\Http\Controllers\Front\WishlistController::class,'index']);
    Route::get('choose',[\App\Http\Controllers\Front\WishlistController::class,'choose']);
    Route::get('add',[\App\Http\Controllers\Front\WishlistController::class,'addToWishlist']);
    Route::get('addCart',[\App\Http\Controllers\Front\WishlistController::class,'addCartWl']);
    Route::get('updateColor',[\App\Http\Controllers\Front\WishlistController::class,'updateColor']);
    Route::get('updateSize',[\App\Http\Controllers\Front\WishlistController::class,'updateSize']);
    Route::get('delete',[\App\Http\Controllers\Front\WishlistController::class,'delete']);
    Route::get('destroy',[\App\Http\Controllers\Front\WishlistController::class,'destroy']);
});
Route::get('checkout',[\App\Http\Controllers\Front\OrderController::class,'checkout'])->withoutMiddleware('CheckMemberLogin');
Route::prefix('order')->group(function (){
    Route::post('',[\App\Http\Controllers\Front\OrderController::class,'addOrder']);
    Route::get('myOrder',[\App\Http\Controllers\Front\OrderController::class,'orderHistory']);
    Route::get('myOrder/{id}',[\App\Http\Controllers\Front\OrderController::class,'orderDetail']);
    Route::get('submit/{orderId}',[\App\Http\Controllers\Front\OrderController::class,'submitOrder']);
    Route::get('cancel/{orderId}',[\App\Http\Controllers\Front\OrderController::class,'cancelOrder']);
});
