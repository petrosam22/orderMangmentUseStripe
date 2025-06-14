<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductSearch;
use App\Http\Requests\ProductRequest;
use App\Services\Api\ProductsService;

class ProductsController extends Controller
{
    protected $service;

    public function __construct(ProductsService $service)
    {

        $this->service = $service;
    }

       public function store(ProductRequest $request)
    {
       return $this->service->create($request);
    }
       public function index()
    {
       return $this->service->getProducts();
    }

       public function search(ProductSearch $request)
    {

    $name = $request->get('name'); // أو: $request->get('name')
    return $this->service->searchProduct($name);
    }


}
