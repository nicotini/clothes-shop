<?php
namespace App\Service;

use App\Models\Attribute;

class AttributeService
{
   public function getAllAttributes()
   {
    $attributes = Attribute::orderBy('name')->get();
    return $attributes;
   } 
   
}