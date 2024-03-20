<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    private $categories = [
        "Instrumentos de percussão",
        "Acessórios para instrumentos musicais",
        "CDs e vinis",
        "Filmes e DVDs",
        "Livros",
        "E-books e audiolivros",
        "Material de escritório",
        "Papelaria",
        "Canetas e lápis",
        "Artigos de arte e artesanato",
        "Material para desenho e pintura",
        "Material para scrapbooking",
        "Materiais para costura e tricô",
        "Ferramentas de jardinagem",
        "Plantas e sementes",
        "Vasos e jardinagem",
        "Móveis de jardim",
        "Equipamentos de iluminação",
        "Decoração de interiores",
        "Móveis para casa",
        "Têxteis para o lar",
        "Utensílios de cozinha",
        "Eletrodomésticos",
        "Produtos de limpeza doméstica",
        "Produtos de papelaria",
        "Equipamentos de escritório",
        "Computadores e laptops",
        "Tablets e e-readers",
        "Smartphones",
        "Acessórios para dispositivos eletrônicos",
        "Impressoras e scanners",
        "Acessórios para impressoras",
        "Componentes de computador",
        "Software",
        "Serviços de computação em nuvem",
        "Produtos alimentícios",
        "Bebidas",
        "Snacks e petiscos",
        "Alimentos gourmet",
        "Produtos orgânicos",
        "Alimentos sem glúten",
        "Produtos lácteos",
        "Carne e aves",
        "Peixes e frutos do mar",
        "Frutas e legumes",
        "Produtos congelados",
        "Alimentos enlatados e embalados",
        "Produtos de padaria e confeitaria",
        "Bebidas alcoólicas",
        "Bebidas não alcoólicas",
        "Café e chá",
        "Refrigerantes e sucos",
        "Água engarrafada",
        "Vinhos",
        "Cervejas",
        "Destilados",
        "Vinhos espumantes",
        "Bebidas energéticas",
        "Suprimentos para festas",
        "Decoração de festas",
        "Artigos para festas temáticas",
        "Jogos de tabuleiro",
        "Quebra-cabeças",
        "Brinquedos infantis",
        "Bonecas e acessórios",
        "Carrinhos e veículos de brinquedo",
        "Jogos eletrônicos",
        "Brinquedos educativos",
        "Brinquedos de pelúcia",
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement($this->categories)
        ];
    }
}
