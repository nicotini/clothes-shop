<?php

namespace App\Http\Controllers\Api\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\FilterRequest;
use App\Service\FilterService;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    protected $filterService;
    public function __construct(FilterService $filterService)
    {
        $this->filterService = $filterService; 
    }
    /**
     * Handle the incoming request.
     */
    public function __invoke(FilterRequest $request, $perPage = 9)
    {
        $filteredCategories = $request->input('filterCat', []);
        $minPrice = $request->input('filterPriceMin', 0);
        $maxPrice = $request->input('filterPriceMax', PHP_FLOAT_MAX);
        $selectedAttributes = $request->input('filterAttr', []);

        $filteredProducts = $this->filterService->filterProducts($filteredCategories, $minPrice, $maxPrice, $selectedAttributes);
        $products = $filteredProducts->paginate($perPage);
        return response()->json($products, 200);
    }
}
