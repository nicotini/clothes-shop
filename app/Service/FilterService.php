<?php

namespace App\Service;

use App\Http\Requests\FilterReqiest;
use App\Models\Category;
use App\Models\Product;

class FilterService
{
    public function filterProducts($categories, $minPrice, $maxPrice, $selectedAttributes)
    {
        $query = Product::query();
        // get all the categories and child catogories
        if (!empty($categories)) {
            $allCategories = $this->getAllChildCategories($categories);
            $query->whereIn('category_id', $allCategories);
        }

        $query->whereBetween('price', [$minPrice, $maxPrice]);

        if (!empty($selectedAttributes)) {
            foreach ($selectedAttributes as $attributeId => $attributeValueId) {
                // Добавьте условие для каждого выбранного атрибута и его значения
                $query->whereHas('attributes', function ($query) use ($attributeId, $attributeValueId) {
                    $query->where('attribute_id', $attributeId)
                        ->where('attribute_value_id', $attributeValueId);
                });
            }
        }

        return $query;
    }

    private function getAllChildCategories($cats)
    {
        $childCategories = Category::whereIn('category_id', $cats)->pluck('id')->toArray();
        if (empty($childCategories)) {
            return $cats;
        }
        return array_merge($cats, $this->getAllChildCategories($childCategories));
    }
}
