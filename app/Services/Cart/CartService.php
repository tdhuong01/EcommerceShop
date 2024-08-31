<?php

namespace App\Services\Cart;

use App\Repositories\Cart\CartRepositoryInterface;
use App\Services\BaseService;

class CartService extends BaseService implements CartServiceInterface
{
    public $repository;

    public function __construct(CartRepositoryInterface $cartRepository)
    {
        $this->repository = $cartRepository;
    }
    public function totalPrice($userId){
        $this->repository->totalPrice($userId);
    }
}
