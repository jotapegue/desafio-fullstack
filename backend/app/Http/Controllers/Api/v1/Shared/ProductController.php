<?php

namespace App\Http\Controllers\Api\v1\Shared;

use App\Http\Controllers\Controller;
use App\Http\Resources\Shared\ProductResource;
use App\Models\Product;

class ProductController extends Controller
{
    public function __invoke()
    {
        $query = Product::query();

        if (request()->has('category')) {
            $query = $query->category(request()->category);
        }

        return ProductResource::collection($query->get());
    }
}
