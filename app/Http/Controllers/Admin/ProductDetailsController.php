<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductDetail;
use App\Services\Product\ProductServiceInterface;
use App\Services\ProductDetail\ProductDetailServiceInterface;
use Illuminate\Http\Request;

class ProductDetailsController extends Controller
{
    private $productService;
    private $productDetailService;
    public function __construct(ProductServiceInterface $productService,ProductDetailServiceInterface $productDetailService)
    {
        $this->productService = $productService;
        $this->productDetailService = $productDetailService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($product_id)
    {
        $products = $this->productService->find($product_id);
        $productDetails= $this->productDetailService->all();
        return view('admin.product.detail.index',compact('products','productDetails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($product_id)
    {
        $product = $this->productService->find($product_id);
        return view('admin.product.detail.create',compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$product_id)
    {
        $data = $request->all();
        $data['color'] = $request->color != null ? $request->color:"Chỉ một màu";
        $check = ProductDetail::where('product_id',$product_id)->where('color',$data['color'])
            ->where('size',$data['size'])->first();
        if(!$check) {
            ProductDetail::create($data);
            $this->updateQty($product_id);
            if (session('create_pro') != 1 || session('update_pro') == 1){
                return redirect('admin/product/' . $product_id . '/detail')
                    ->with('notification','Cập nhật thành công.');;
            }else{
                return back();
            }

        }else{
            return redirect('admin/product/' . $product_id . '/detail/create')
                ->with('notification','Sản phẩm có các đặc điểm này đã tồn tại.');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($product_id,$productDetail_id)
    {
        $product = $this->productService->find($product_id);
        $productDetail = ProductDetail::find($productDetail_id);
        return view('admin.product.detail.edit',compact('product','productDetail'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id , $productDetail_id)
    {
        $data = $request->all();
        ProductDetail::find($productDetail_id)->update($data);
        $this->updateQty($id);
        return redirect('admin/product/'.$id.'/detail');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($product_id, $productDetail_id)
    {
        ProductDetail::find($productDetail_id)->delete();

        return redirect('admin/product/'.$product_id.'/detail');
    }

    public function updateQty($product_id){
        $product = $this->productService->find($product_id);
        $productDetail = $product->productDetails;
        $totalQty = array_sum(array_column($productDetail->toArray(),'qty'));
        $this->productService->update(['qty'=>$totalQty],$product_id);
    }
}
