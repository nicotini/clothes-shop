<?php

namespace App\Http\Controllers\Shop;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Service\AttributeService;
use App\Service\CategoryService;
use App\Http\Requests\FilterRequest;
use App\Service\FilterService;

class ProductFilterController extends Controller
{
    protected $filterService;

    protected $categoryService;
    protected $attributeService;

    public function __construct(FilterService $filterService, CategoryService $categoryService, AttributeService $attributeService)
    {
        $this->filterService = $filterService;
        $this->categoryService = $categoryService;
        $this->attributeService = $attributeService;
    }

    public function __invoke(FilterRequest $request, $perPage = 9)
    {        
        $filteredCategories = $request->input('filterCat', []);
        dd($filteredCategories);
        $minPrice = $request->input('filterPriceMin', 0);
        $maxPrice = $request->input('filterPriceMax', PHP_FLOAT_MAX);
        $selectedAttributes = $request->input('filterAttr', []);

        $categories = $this->categoryService->getAllCategories();
        $attributes = $this->attributeService->getAllAttributes();
        $max = Product::max('price');
        $min = Product::min('price');
        // $products = Product::paginate($perPage);
        $filteredProducts = $this->filterService->filterProducts($filteredCategories, $minPrice, $maxPrice, $selectedAttributes);
        $products = $filteredProducts->paginate($perPage);
        // $filteredProducts = $this->filterService->filterProducts($filteredCategories, $minPrice, $maxPrice, $selectedAttributes);

        // return view('shop.index', compact('filteredProducts'));
        return view('shop.index', compact('products', 'categories', 'attributes', 'max', 'min'));
    }
}
