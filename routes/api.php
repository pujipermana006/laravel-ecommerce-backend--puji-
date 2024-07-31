<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//register seller
Route::post('/seller/register', [App\Http\Controllers\Api\AuthController::class, 'registerSeller']);

//login
Route::post('/login', [App\Http\Controllers\Api\AuthController::class, 'login']);

//logout
Route::post('/logout', [App\Http\Controllers\Api\AuthController::class, 'logout'])->middleware('auth:sanctum');

//register customer
Route::post('/buyer/register', [App\Http\Controllers\Api\AuthController::class, 'registerBuyer']);

//story category
Route::post('/seller/category', [App\Http\Controllers\Api\CategoryController::class, 'store'])->middleware('auth:sanctum');

//get all categories]
Route::get('/seller/categories', [App\Http\Controllers\Api\CategoryController::class, 'index'])->middleware('auth:sanctum');

//product
Route::apiResource('/seller/product', App\Http\Controllers\Api\ProductController::class)->middleware('auth:sanctum');

//update product
Route::post('/seller/product/{id}', [App\Http\Controllers\Api\ProductController::class, 'update'])->middleware('auth:sanctum');

//address
Route::apiResource('/buyer/address', App\Http\Controllers\Api\AddressController::class)->middleware('auth:sanctum');

//order
Route::post('/buyer/order', [App\Http\Controllers\Api\OrderController::class, 'createOrder'])->middleware('auth:sanctum');