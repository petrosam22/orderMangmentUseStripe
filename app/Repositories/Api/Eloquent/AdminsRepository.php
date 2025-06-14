<?php

namespace App\Repositories\Api\Eloquent;

use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Api\Contracts\AdminsRepositoryInterface;
use App\Http\Requests\LoginRequest;

class AdminsRepository implements AdminsRepositoryInterface
{
     protected $admin;
    public function __construct(Admin $admin)
    {
        $this->admin = $admin;

    }

            public function register($data){
                $this->admin->create($data);
            }

    public function login($request)
    {
        $admin = Admin::where('email', $request->email)->first();

        if (!$admin || !Hash::check($request->password, $admin->password)) {
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        $token = $admin->createToken('admin-token')->plainTextToken;
        return ['admin' => $admin, 'token' => $token];
    }
}
