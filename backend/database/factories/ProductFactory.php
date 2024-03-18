<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    private $products = [
        'Smartphone',
        'Notebook',
        'Videogame',
        'Smartwatche',
        'Fone de Ouvido sem Fio',
        'Tripé para Celular',
        'Capinha de Celular',
        'Lâmpada inteligente',
        'Carregador Portátil',
        'Air Fryer',
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement($this->products),
            'description' => fake()->text(),
            'price' => fake()->randomElement(range(0.99, 100)),
            'due_in' => fake()->date(),
            'image' => fake()->imageUrl(),
        ];
    }
}
