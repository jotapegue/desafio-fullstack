<?php

namespace Tests\Feature\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function returnAllCategory()
    {
        $categories = Product::factory()
            ->count(3)
            ->forCategory()
            ->create();

        $this->get(route('api.v1.admin.product.index'))
            ->assertOk()
            ->assertJson([
                'data' => $categories->toArray()
            ]);
    }

    /** @test */
    public function storeProduct()
    {
        $form = Product::factory()
            ->make()
            ->toArray();

        $form['due_in'] = now()->toDateString();
        $form['image'] = new UploadedFile(
            fake()->image(), 'image.jpg', 'image/jpeg', null, true
        );

        $form['category_id'] = Category::factory()->create()->id;

        $this->postJson(route('api.v1.admin.product.store'), data: $form)
            ->assertCreated();
    }

    /** @test */
    public function dontStoreWithoutImage()
    {
        $form = Product::factory()
            ->make()
            ->toArray();

        $form['due_in'] = now()->toDateString();
        $form['category_id'] = Category::factory()->create()->id;

        $this->postJson(route('api.v1.admin.product.store'), data: $form)
            ->assertStatus(422)
            ->assertJsonFragment([
                "image" => ["O campo Imagem tem que ser um imagem","O campo Imagem tem que ser do tipo JPG ou PNG"]
            ]);
    }

    /** @test */
    public function dontStoreWithLargeImage()
    {
        $form = Product::factory()
            ->make()
            ->toArray();

        $form['due_in'] = now()->toDateString();
        $form['image'] = new UploadedFile(
            base_path('tests/Feature/Http/files/large_image.jpg'), 'image.jpg', 'image/jpeg', null, true
        );
        $form['category_id'] = Category::factory()->create()->id;

        $this->postJson(route('api.v1.admin.product.store'), data: $form)
            ->assertStatus(422)
            ->assertJsonFragment(
                ["image" => ["O campo Imagem deve ser enviado arquivos com até 2MB"]]
            );
    }

    /** @test */
    public function dontStoreIfSendOtherTypeMime()
    {
        $form = Product::factory()
            ->make()
            ->toArray();

        $form['due_in'] = now()->toDateString();
        $form['image'] = new UploadedFile(
            base_path('tests/Feature/Http/files/document.txt'), 'image.jpg', 'image/jpeg', null, true
        );
        $form['category_id'] = Category::factory()->create()->id;

        $this->postJson(route('api.v1.admin.product.store'), data: $form)
            ->assertStatus(422)
            ->assertJsonFragment(
                ["image" => ["O campo Imagem tem que ser do tipo JPG ou PNG","O campo Imagem tem que ser um imagem"]]
            );
    }

    /** @test */
    public function updateCategory()
    {
        $product = Product::factory()
            ->forCategory()
            ->create();

        Product::factory()
            ->count(10)
            ->forCategory()
            ->create();

        $this->patchJson(route('api.v1.admin.product.update', $product->id), data: ['name' => 'updated'])
            ->assertJsonFragment(['id' => $product->id])
            ->assertJsonFragment(['name' => 'updated']);
    }

    /** @test */
    public function deleteCategory()
    {
        $product = Product::factory()
            ->forCategory()
            ->create();

        Product::factory()
            ->count(10)
            ->forCategory()
            ->create();

        $this->delete(route('api.v1.admin.product.destroy', $product->id))
            ->assertJsonFragment(['message' => 'Produto removido com sucesso']);
    }
}
