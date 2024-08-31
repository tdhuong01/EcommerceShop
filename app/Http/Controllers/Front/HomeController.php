<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Services\Product\ProductServiceInterface;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    private  $productService;

    public function __construct(ProductServiceInterface $productService){
        $this->productService = $productService;
    }

    public function index(){
        $featuredProducts = $this->productService->getFeaturedProducts();

        return view('front.index',compact('featuredProducts'));
    }
    public function contact(){
        return view('front.contact');
    }
}
