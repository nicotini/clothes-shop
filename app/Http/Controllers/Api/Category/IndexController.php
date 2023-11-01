<?php

namespace App\Http\Controllers\Api\Category;

use App\Http\Controllers\Controller;
use App\Service\CategoryService;
use Illuminate\Http\Client\Response;


class IndexController extends Controller
{
    protected $categoryService;
   

   public function __construct(CategoryService $categoryService) 
   {
      $this->categoryService = $categoryService; 
   }
   
    /**
     * Handle the incoming request.
     */
    public function __invoke()
    {
        $categories = $this->categoryService->getAllCategoriesApi();
        
      /*  return $category->childrenCategories; */
        return response()->json($categories, 200);
    }
}
