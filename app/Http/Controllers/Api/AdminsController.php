<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Api\AdminsService;
use App\Http\Requests\LoginRequest;

use App\Http\Requests\RegisterRequest;

class AdminsController extends Controller
{
    protected $service;

    public function __construct(AdminsService $service)
    {
        $this->service = $service;
    }

     public function register(RegisterRequest $request)
    {
        return $this->service->register($request);
    }
    public function login(LoginRequest $request)
    {
        return $this->service->login($request);
    }
}
