<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\ProductCategory;
use App\Models\ProductDetail;
use App\Services\Brand\BrandServiceInterface;
use App\Services\Product\ProductServiceInterface;
use App\Services\ProductCategory\ProductCategoryServiceInterface;
use App\Services\ProductComment\ProductCommentServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ShopController extends Controller
{
    private $productService;
    private $productCommentService;

    public function __construct(ProductServiceInterface $productService,
                                ProductCommentServiceInterface $productCommentService)
    {
        $this->productService =$productService;
        $this->productCommentService = $productCommentService;
    }

    public function show($id){
        $product = $this->productService->find($id);
        $relatedProducts = $this->productService->getRelatedProducts($product);
        return view('front.shop.product',compact('product','relatedProducts'));
    }
    public function postComment(Request $request)
    {
        $data = $request->all();
        $data['user_id'] = Auth::id();
        $data['name'] = Auth::user()->name;
        $data['email'] = Auth::user()->email;
        $this->productCommentService->create($data);

        return redirect()->back();
    }

    public function index(Request $request){
        $categories = ProductCategory::orderBy('name')->get();
        $brands = Brand::orderBy('name')->get();
        $products = $this->productService->getProductOnIndex($request);
        $colors = ProductDetail::select('color')->orderBy('color')->distinct()->get();
        $sizes = ProductDetail::distinct()->orderBy('size')->get(['size']);

        return view('front.shop.index', compact('products','categories','brands','colors','sizes'));
    }
    public function category($name, Request $request){

        $categories = ProductCategory::orderBy('name')->get();
        $brands = Brand::orderBy('name')->get();
        $products = $this->productService->getProductByCategory($name,$request);
        $colors = ProductDetail::select('color')->distinct()->get();
        $sizes = ProductDetail::distinct()->get(['size']);

        return view('front.shop.index', compact('products','categories','brands','colors','sizes'));
    }
    public function tag($tag, Request $request){

        $categories = ProductCategory::orderBy('name')->get();
        $brands = Brand::orderBy('name')->get();
        $products = $this->productService->getProductByTag($tag,$request);
        $colors = ProductDetail::select('color')->distinct()->get();
        $sizes = ProductDetail::distinct()->get(['size']);

        return view('front.shop.index', compact('products','categories','brands','colors','sizes'));
    }

}
