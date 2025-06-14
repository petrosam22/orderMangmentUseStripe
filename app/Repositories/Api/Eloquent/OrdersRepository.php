<?php

namespace App\Repositories\Api\Eloquent;

use App\Models\Order;
use App\Repositories\Api\Contracts\OrdersRepositoryInterface;

class OrdersRepository implements OrdersRepositoryInterface
{

    protected $order;
    public function __construct(Order $order)
    {
        $this->order = $order;

    }
    public function createOrder(array $orderData)
    {
        return $this->order->create($orderData);
    }
}
