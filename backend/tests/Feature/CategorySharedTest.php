<?php

namespace Tests\Feature;

use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategorySharedTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function listAllCategory()
    {
        $categories = Category::factory()
            ->count(3)
            ->create();

        $expected = $categories
            ->map(fn ($item) => ['id' => $item->id, 'name' => $item->name])
            ->toArray();

        $this->get(route('api.v1.public.category.index'))
            ->assertOk()
            ->assertJsonFragment([
                'data' => $expected
            ]);
    }
}
