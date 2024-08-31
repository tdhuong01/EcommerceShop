<?php

namespace App\Services\ProductImage;

use App\Repositories\ProductImage\ProductImageRepositoryInterface;
use App\Services\BaseService;

class ProductImageService extends BaseService implements ProductImageServiceInterface
{
    public $repository;

    public function __construct(ProductImageRepositoryInterface $productImageRepository)
    {
        $this->repository = $productImageRepository;
    }


}
