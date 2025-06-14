<?php

namespace App\Repositories\Api\Contracts;

interface ProductsRepositoryInterface
{
    public function store(array $data);
    public function getProducts();
    public function searchProduct($name);
}
