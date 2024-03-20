<?php

namespace App\Http\Controllers\Api\v1\Admin;

use App\Enums\HttpResponseMessage;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductResquestCreate;
use App\Http\Requests\Admin\ProductResquestUpdate;
use App\Http\Resources\Admin\ProductResource;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ProductResource::collection(Product::paginate(10));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductResquestCreate $request)
    {
        try {
            $data = $request->safe()->toArray();

            if ($request->hasFile('image')) {
                $path = Storage::disk('local')->put("products/{$request->image->getClientOriginalName()}", $request->image);
                $data['image'] = $path;
            }

            return DB::transaction(fn () => Product::create($data));
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
    public function update(ProductResquestUpdate $request, Product $product)
    {
        try {
            DB::transaction(
                fn () => $product->update($request->safe()->toArray())
            );

            return $product;
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
    public function destroy(Product $product)
    {
        try {
            DB::transaction(fn () => $product->delete());
            return response()->json(['message' => 'Produto removido com sucesso']);
        } catch (Exception $e) {
            Log::error($e->getMessage());
            return response()->json(
                ['message' => HttpResponseMessage::REQUEST_ERROR_PROCESS->value],
                status: 500
            );
        }
    }
}
