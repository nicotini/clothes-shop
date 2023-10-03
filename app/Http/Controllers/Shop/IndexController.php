<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Service\AttributeService;
use App\Service\CategoryService;

class IndexController extends Controller

{
   protected $categoryService;
   protected $attributeService;
   protected $productService;

   public function __construct(
      CategoryService $categoryService,
      AttributeService $attributeService

   ) {
      $this->categoryService = $categoryService;
      $this->attributeService = $attributeService;
   }

   public function __invoke($perPage = 9)
   {
      $categories = $this->categoryService->getAllCategories();
      $attributes = $this->attributeService->getAllAttributes();
      $max = Product::max('price');
      $min = Product::min('price');
      $products = Product::with('productAttributes')->paginate($perPage);
   
      return view('shop.index', compact('products', 'categories', 'attributes', 'max', 'min'));
   }
}
