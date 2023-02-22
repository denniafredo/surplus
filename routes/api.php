<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategoryProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(ProductController::class)->group(function () {
    Route::get('/products', 'index');
    Route::get('/products/{id}', 'show');
    Route::post('/products', 'store');
    Route::put('/products/{id}', 'update');
    Route::delete('/products/{id}', 'destroy');
});

Route::controller(CategoryController::class)->group(function () {
    Route::get('/categories', 'index');
    Route::get('/categories/{id}', 'show');
    Route::post('/categories', 'store');
    Route::put('/categories/{id}', 'update');
    Route::delete('/categories/{id}', 'destroy');
});

Route::controller(CategoryProductController::class)->group(function () {
    Route::get('/categoryproducts', 'index');
    Route::get('/categoryproducts/{id}', 'show');
    Route::post('/categoryproducts', 'store');
    Route::delete('/categoryproducts/{id}', 'destroy');
});

Route::controller(ImageController::class)->group(function () {
    Route::get('/images', 'index');
    Route::get('/images/{id}', 'show');
    Route::post('/images', 'store');
    Route::put('/images/{id}', 'update');
    Route::delete('/images/{id}', 'destroy');
});
