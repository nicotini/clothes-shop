<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $product_name = fake()->sentence();
        $slug = Str::slug($product_name, '-');
        return [
            'name' => $product_name,
            'desc' => fake()->text,
            'slug' => $slug ,
            'category_id' => Category::query()->inRandomOrder()->first()->value('id'),
            'price' => fake()->numberBetween(100, 500),
            'quantity' => fake()->default(0),
        ];
    }
}
