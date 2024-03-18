<?php

namespace App\Http\Controllers\Api\v1\Shared;

use App\Http\Controllers\Controller;
use App\Http\Resources\Shared\ProductResource;
use App\Models\Product;

class ProductController extends Controller
{
    public function __invoke()
    {
        return ProductResource::collection(Product::all());
    }
}
