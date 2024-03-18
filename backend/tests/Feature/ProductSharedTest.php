<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductSharedTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function listAllProduct()
    {
        $products = Product::factory()
            ->count(5)
            ->forCategory()
            ->create();

        $data = $products
            ->map(fn ($item) => [
                'name' => $item->name,
                'description' => $item->description,
                'price' => $item->price,
                'due_in' => $item->due_in,
                'image' => $item->image,
                'category' => [
                    'id' => $item->category->id,
                    'name' => $item->category->name
                ],
            ])
            ->toArray();

        $this->get(route('api.v1.public.product.index'))
            ->assertOk()
            ->assertJsonFragment([
                'data' => $data
            ]);
    }

    /** @test */
    public function listProductsFromCategory()
    {
        $category_one = Category::factory()->create(['name' => 'Category one']);
        $category_two = Category::factory()->create(['name' => 'Category two']);


        Product::factory()
            ->count(10)
            ->for($category_one)
            ->create();

        $products = Product::factory()
            ->count(5)
            ->for($category_two)
            ->create();

        $data = $products
            ->map(fn ($item) => [
                'name' => $item->name,
                'description' => $item->description,
                'price' => $item->price,
                'due_in' => $item->due_in,
                'image' => $item->image,
                'category' => [
                    'id' => $item->category->id,
                    'name' => $item->category->name
                ],
            ])
            ->toArray();

        $this->get(route('api.v1.public.product.index', ['category' => $category_two->id]))
            ->assertOk()
            ->assertJsonFragment([
                'data' => $data
            ]);
    }
}
