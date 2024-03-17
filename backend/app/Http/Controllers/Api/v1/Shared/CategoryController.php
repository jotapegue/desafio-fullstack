<?php

namespace App\Http\Controllers\Api\v1\Shared;

use App\Http\Controllers\Controller;
use App\Http\Resources\Shared\CategoryResource;
use App\Models\Category;

class CategoryController extends Controller
{
    public function __invoke()
    {
        return CategoryResource::collection(Category::all());
    }
}
