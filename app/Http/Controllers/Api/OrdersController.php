<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Api\OrdersService;
use App\Http\Requests\OrderRequest;
class OrdersController extends Controller
{
    protected $service;

    public function __construct(OrdersService $service)
    {
        $this->service = $service;
    }

        public function store(OrderRequest $request)
    {
        try {
            $order = $this->service->processOrder($request->validated());
            return response()->json([
                'message' => 'Order placed successfully',
                'order' => $order
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Order failed: ' . $e->getMessage()
            ], 400);
        }
    }

}
