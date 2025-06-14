<?php

namespace App\Repositories\Api\Eloquent;

use App\Models\Product;
use App\Repositories\Api\Contracts\ProductsRepositoryInterface;

class ProductsRepository implements ProductsRepositoryInterface
{


     protected $product;
    public function __construct(Product $product)
    {
        $this->product = $product;
    }

public function store(array $data)
    {
        return  $this->product->create($data);
    }

    public function getProducts()
    {
        return  $this->product->all();
    }

    public function searchProduct($name){
    return Product::where('name', 'like', "%$name%")->get();
    }

}
