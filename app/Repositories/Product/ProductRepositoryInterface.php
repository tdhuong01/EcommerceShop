<?php

namespace App\Repositories\Product;

use App\Repositories\RepositoryInterface;

interface ProductRepositoryInterface extends RepositoryInterface
{
    public function getRelatedProducts($product, $limit = 4);
    public function getFeaturedProducts($tag);
    public function getProductOnIndex($request);
    public function getProductByCategory($name, $request);
    public function getProductByTag($tag, $request);
    public function pagination();
}
