<?php

namespace App\Repositories\Product;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;

class ProductRepository extends BaseRepository implements ProductRepositoryInterface
{

    public function getModel()
    {
        return Product::class;
    }
    public function getRelatedProducts($product, $limit = 4){
        return $this->model->where('product_category_id', $product->product_category_id)
                ->where('tag', $product->tag)
                ->where('qty','>',0)->where('id','!=',$product->id)
                ->limit($limit)
                ->get();
    }

    public function getFeaturedProducts($tag){
        return $this->model->where('featured',true)
            ->where('tag','like','%'.$tag.'%')
            ->where('qty','>',0)
            ->get();
    }

    public function getProductOnIndex($request){

        $search = $request->search ?? '';

        $products = $this->model->where('name','like','%'.$search.'%')->where('qty','>',0);

        $products = $this->filter($products,$request);
        $products = $this->sortAndPagination($products, $request);

        return $products;
    }
    public function getProductByCategory($name, $request){
        $products = $this->model->where('product_category_id',$name)->where('qty','>',0);
        $products = $this->filter($products,$request);
        $products = $this->sortAndPagination($products, $request);
        return $products;
    }
    public function getProductByTag($tag, $request){
        $products = $this->model->where('tag','like','%'.$tag.'%')->where('qty','>',0);
        $products = $this->filter($products,$request);
        $products = $this->sortAndPagination($products, $request);
        return $products;
    }
    private function sortAndPagination($products, Request $request){
        $perPage = $request->show ?? 9;
        $sortBy = $request->sort_by ?? 'latest';

        switch ($sortBy) {
            case 'latest':
                $products = $products->orderByDesc('id');
                break;
            case 'oldest':
                $products = $products->orderBy('id');
                break;
            case 'name-ascending':
                $products = $products->orderBy('name');
                break;
            case 'name-descending':
                $products = $products->orderByDesc('name');
                break;
            case 'price-ascending':
                $products = $products->orderBy('price');
                break;
            case 'price-descending':
                $products = $products->orderByDesc('price');
                break;
            default:
                $products = $products->orderBy('id');
        }
        $products = $products->paginate($perPage);

        $products->appends(['sort_by'=> $sortBy ,'show' => $perPage]);

        return $products;
    }
    private function filter($products, Request $request){
        //Brand
        $brand = $request->brand ?? [];
        $brand_id = array_keys($brand);
        $products = $brand_id !=null ? $products->whereIn('brand_id',$brand_id)->where('qty','>',0) : $products;

        //Price
        $price_min = $request->price_min;
        $price_max = $request->price_max;

        $products = ($price_min != null && $price_max != null)
            ? $products->whereBetween('price',[$price_min,$price_max]):$products;

        //Color
        $color = $request->color;
        $products = $color != null ? $products->whereHas('productDetails',function ($query) use ($color){
            return $query->where('color',$color)->where('qty','>',0);
        }) : $products;

        //Size
        $size = $request->size;
        $products = $size != null ? $products->whereHas('productDetails',function ($query) use ($size){
            return $query->where('size',$size)->where('qty','>',0);
        }) : $products;
        return $products;

    }

    public function pagination(){
        $products = $this->model->paginate();
        return $products;
    }
}
