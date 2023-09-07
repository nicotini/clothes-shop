<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Log;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products =  Product::all();
        
        foreach ($products as $product) {
            
            $totalQuantity = $product->attributes->sum('pivot.quantity');
            $product->quantity = $totalQuantity;
            $product->save();

        }

        
    }
}
