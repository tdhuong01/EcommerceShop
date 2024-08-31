<?php

namespace App\Repositories\Cart;

use App\Repositories\RepositoryInterface;

interface CartRepositoryInterface extends RepositoryInterface
{
    public function totalPrice($userId);
}
