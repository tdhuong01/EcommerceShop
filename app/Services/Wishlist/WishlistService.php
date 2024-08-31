<?php

namespace App\Services\Wishlist;

use App\Repositories\Wishlist\WishlistRepositoryInterface;
use App\Services\BaseService;

class WishlistService extends BaseService implements WishlistServiceInterface
{
    public $repository;

    public function __construct(WishlistRepositoryInterface $cartRepository)
    {
        $this->repository = $cartRepository;
    }
}
