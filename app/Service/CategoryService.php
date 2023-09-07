<?php
namespace App\Service;

use App\Models\Category;

class CategoryService
{
    public function getAllCategories()
    {
        $categories = Category::whereNull('category_id')
        ->with('childrenCategories')
        ->get();
       
         return $categories;
    }
}