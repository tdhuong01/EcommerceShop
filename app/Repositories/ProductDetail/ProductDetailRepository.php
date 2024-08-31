<?php

namespace App\Repositories\ProductDetail;

use App\Models\ProductDetail;
use App\Repositories\BaseRepository;

class ProductDetailRepository extends BaseRepository implements ProductDetailRepositoryInterface
{
    public function getModel()
    {
        return ProductDetail::class;
    }

    public function pagination(){
        $productDetails = $this->model->paginate();
        return $productDetails;
    }
}
