<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductDetail;
use App\Models\ProductImage;
use App\Services\Brand\BrandServiceInterface;
use App\Services\Product\ProductServiceInterface;
use App\Services\ProductCategory\ProductCategoryServiceInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $productService;
    private $productCategoryService;
    private $brandService;

    public function __construct(ProductServiceInterface $productService,
                                ProductCategoryServiceInterface $productCategoryService,
                                BrandServiceInterface $brandService)
    {
        $this->productService = $productService;
        $this->brandService = $brandService;
        $this->productCategoryService = $productCategoryService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->productService->all();
        session()->forget('create_pro');
        session()->forget('update_pro');
        return view('admin.product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = $this->brandService->all();
        $categories = $this->productCategoryService->all();
        session()->forget('update_pro');
        return view('admin.product.create',compact('brands','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $check = Product::where('name',$request->name)->first();
        if ($check == null){
            $data['qty'] = 0;
            $data['sku'] = rand(0,100000);
            $check = Product::where('sku',$data['sku'])->get();
            if($check){
                $data['sku'] = rand(0,100000);
            }
            $product = $this->productService->create($data);
            session(['create_pro'=>1]);
            return redirect('admin/product/' .$product->id.'/image');
        }else{
            return back()->with('notification','Lỗi: Sản phẩm đã tồn tại');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = $this->productService->find($id);
        return view('admin.product.show',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $products = $this->productService->find($id);
        $brands = $this->brandService->all();
        $categories = $this->productCategoryService->all();
        session()->forget('create_pro');
        session(['update_pro'=>1]);
        return view('admin.product.edit',compact('products','brands','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();
        $this->productService->update($data,$id);
        if(session('update_pro') == 1){
            return back()->with('success','Cập nhật thông tin cơ bản thành công.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $images = ProductImage::where('product_id',$id)->get();

        foreach($images as $image)
        {
            $image->delete();
        }
        $details = ProductDetail::where('product_id',$id)->get();
        foreach($details as $detail)
        {
            $detail->delete();
        }

        $this->productService->delete($id);
        return redirect('admin/product');
    }
}
