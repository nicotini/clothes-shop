<?php

namespace Database\Seeders;

use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Category;
use App\Models\Product;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rootCategories = Category::factory(1)->create();
        foreach ($rootCategories as $rootCategory) {
            $this->createNestedCategories($rootCategory, 3);
            
        }
        
       

    }

    protected function createNestedCategories($parentCategory, $depth)
    {
        if ($depth <= 0) {
            return;
        }

        $childCategories = Category::factory(rand(2,3))->create([
            'category_id' => $parentCategory->id,
        ]);

        foreach ($childCategories as $childCategory) {
            $this->createNestedCategories($childCategory, $depth - 1);
            
        }
        $this->productsForCategories($childCategories);
    }

    protected function productsForCategories($childCategories) {
        foreach($childCategories as $category) {
            if($category->isLeaf()) {
                $products = Product::factory(2)->for($category)->create();
                foreach($products as $product) {
                    $attributes = Attribute::inRandomOrder()->take(rand(1, 3))->get();
                    foreach ($attributes as $attribute) {
                        $attributeValues = $attribute->attributeValues->pluck('id');
                        $attributeValue = $attributeValues->random();
                        $quantity = rand(1, 20);
                        $product->attributes()->attach([
                            $attribute->id => [
                                'attribute_value_id' => $attributeValue,
                                'quantity' => $quantity,
                                    ],
                            
                        ]);
                    }
                }
            }
        }
    }


}
