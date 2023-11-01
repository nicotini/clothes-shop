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

    public function getAllCategoriesApi()
    {
        $rootCategories = Category::whereNull('category_id')->with('categories')->get();

        return $this->buildTree($rootCategories);
    }

    private function buildTree($categories)
    {
        $categoryTree = [];

        foreach ($categories as $category) {
            $childCategories = $category->categories;

            if ($childCategories->isNotEmpty()) {
                $category->categories = $this->buildTree($childCategories);
            }

            $categoryTree[] = $category;
        }

        return $categoryTree;
    }
}
