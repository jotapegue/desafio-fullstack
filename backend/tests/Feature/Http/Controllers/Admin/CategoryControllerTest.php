<?php

namespace Tests\Feature\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function returnAllCategory()
    {
        $categories = Category::factory()
            ->count(3)
            ->create();

        $this->get(route('api.v1.admin.categories.index'))
            ->assertOk()
            ->assertJson([
                'data' => $categories->toArray()
            ]);
    }

    /** @test */
    public function storeCategory()
    {
        $form = Category::factory()->make()->toArray();

        $this->post(route('api.v1.admin.categories.store'), data: $form)
            ->assertCreated()
            ->assertJsonFragment($form);
    }

    /** @test */
    public function dontStoreIfNameCategoryIsNotSend()
    {
        $this->post(route('api.v1.admin.categories.store'))
            ->assertStatus(422)
            ->assertJsonFragment(["name" => ["O campo Nome é não pode ser vazio"]]);
    }

    /** @test */
    public function dontStoreIfNameCategoryMin()
    {
        $this->post(route('api.v1.admin.categories.store'), data: ['name' => 'ac'])
            ->assertStatus(422)
            ->assertJsonFragment(["name" => ["O campo Nome não pode ser menor que 3"]]);
    }

    /** @test */
    public function dontStoreIfNameCategoryIfMax()
    {
        $this->post(route('api.v1.admin.categories.store'), data: ['name' => fake()->text(201)])
            ->assertStatus(422)
            ->assertJsonFragment(["name" => ["O campo Nome não pode ser maior que 200"]]);
    }

    /** @test */
    public function updateCategory()
    {
        $category = Category::factory()->create();
        Category::factory()->count(10)->create();

        $this->patchJson(route('api.v1.admin.categories.update', $category->id), data: ['name' => 'updated'])
            ->assertJsonFragment(['id' => $category->id])
            ->assertJsonFragment(['name' => 'updated']);
    }

    /** @test */
    public function deleteCategory()
    {
        $category = Category::factory()->create();
        Category::factory()->count(10)->create();

        $this->delete(route('api.v1.admin.categories.destroy', $category->id))
            ->assertJsonFragment(['message' => 'Categoria removida com sucesso']);
    }
}
