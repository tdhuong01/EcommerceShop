<?php

namespace App\Services\Cart;

use App\Services\ServiceInterface;

interface CartServiceInterface extends ServiceInterface
{
    public function totalPrice($userId);
}
