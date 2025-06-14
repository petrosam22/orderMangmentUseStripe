<?php

namespace App\Repositories\Api\Contracts;
use App\Http\Requests\LoginRequest;

interface AdminsRepositoryInterface
{
        public function register($data);
    public function login(LoginRequest $request);
}
