<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Enums\HttpResponseMessage;
use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryResquestCreate;
use App\Http\Requests\Admin\CategoryResquestUpdate;
use App\Http\Resources\Admin\CategoryResource;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CategoryResource::collection(Category::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryResquestCreate $request)
    {
        try {
            return DB::transaction(fn () => Category::create(
                $request->safe()->toArray()
            ));
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json(
                ['message' => HttpResponseMessage::REQUEST_ERROR_PROCESS->value],
                status: 500
            );
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryResquestUpdate $request, Category $category)
    {
        try {
            DB::transaction(
                fn () => $category->update($request->safe()->toArray())
            );

            return $category;
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json(
                ['message' => HttpResponseMessage::REQUEST_ERROR_PROCESS->value],
                status: 500
            );
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            DB::transaction(fn () => Category::firstOrFail($id)->delete());
            return response()->json(['message' => 'Categoria removida com sucesso']);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json(
                ['message' => HttpResponseMessage::REQUEST_ERROR_PROCESS->value],
                status: 500
            );
        }
    }
}
