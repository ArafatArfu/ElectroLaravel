<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application.
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Products API
Route::get('/products', [App\Http\Controllers\Api\ProductController::class, 'index']);
Route::get('/products/{id}', [App\Http\Controllers\Api\ProductController::class, 'show']);
Route::get('/products/featured', [App\Http\Controllers\Api\ProductController::class, 'featured']);

// Categories API
Route::get('/categories', [App\Http\Controllers\Api\CategoryController::class, 'index']);
Route::get('/categories/{id}', [App\Http\Controllers\Api\CategoryController::class, 'show']);

// Cart API
Route::post('/cart/add', [App\Http\Controllers\Api\CartController::class, 'add']);
Route::post('/cart/update', [App\Http\Controllers\Api\CartController::class, 'update']);
Route::post('/cart/remove', [App\Http\Controllers\Api\CartController::class, 'remove']);
Route::post('/cart/clear', [App\Http\Controllers\Api\CartController::class, 'clear']);
Route::get('/cart', [App\Http\Controllers\Api\CartController::class, 'index']);

// Newsletter API
Route::post('/newsletter/subscribe', [App\Http\Controllers\Api\NewsletterController::class, 'subscribe']);
