<?php

namespace App\Service;

use App\Models\Product;

class ProductService
{
    public function getProductBySlug($slug)
    {
        return Product::where('slug', $slug)->first();
    }
}
