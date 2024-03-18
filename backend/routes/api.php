<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Api\v1\Shared\CategoryController;
use App\Http\Controllers\Api\v1\Shared\ProductController;

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

Route::prefix('v1')
    ->as('v1.')
    ->group(function () {
        Route::prefix('public')
            ->as('public.')
            ->group(function () {
                Route::get('/categories', CategoryController::class)->name('category.index');
                Route::get('/products', ProductController::class)->name('product.index');
            });
    });
