<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AdminsController;
use App\Http\Controllers\Api\ProductsController;
use App\Http\Controllers\Api\OrdersController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');




Route::prefix('admin')->group(function () {
    Route::post('/register', [AdminsController::class, 'register']);
    Route::post('/login', [AdminsController::class, 'login']);
 });



Route::middleware('auth:sanctum')->prefix('products')->group(function () {
    Route::post('/', [ProductsController::class, 'store']); // Create
    Route::get('/list', [ProductsController::class, 'index']);  // List
    Route::get('/search', [ProductsController::class, 'search']);  // List
});
Route::middleware('auth:sanctum')->prefix('orders')->group(function () {
    Route::post('/', [OrdersController::class, 'store']); // Create
 });



