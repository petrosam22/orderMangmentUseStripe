<?php

namespace App\Services\Api;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Repositories\Api\Contracts\AdminsRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class AdminsService
{
      protected $adminsRepository;

    public function __construct(AdminsRepositoryInterface $adminsRepository)
    {
        $this->adminsRepository = $adminsRepository;
    }

      public function register(RegisterRequest $request)
    {
    $data = $request->validated();
    $data['password'] = Hash::make($data['password']);

     $this->adminsRepository->register($data);

     return response()->json([
        'message'=>'User Register Successfully',
     ]);

}
      public function login(LoginRequest $request)
    {
        return $this->adminsRepository->login($request);
    }
}
