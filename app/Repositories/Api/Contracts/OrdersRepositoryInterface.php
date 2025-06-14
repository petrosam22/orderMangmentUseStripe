<?php

namespace App\Repositories\Api\Contracts;

interface OrdersRepositoryInterface
{
    public function createOrder(array $orderData);
}
