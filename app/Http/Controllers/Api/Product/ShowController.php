<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\Controller;
use App\Service\ProductService;

class ShowController extends Controller
{
    /**
     * Handle the incoming request.
     */
    protected $productService;
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }
    public function __invoke($slug)
    {
        $product = $this->productService->getProductBySlug($slug);
        return response()->json($product, 200);
    }
}
