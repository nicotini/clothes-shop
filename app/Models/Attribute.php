<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;
    protected $tables = 'attributes';
    protected $guarded = false;

    public function attributeValues()
    {
        return $this->hasMany(AttributeValue::class, 'attribute_id', 'id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_attributes')->withPivot('attribute_value_id');
    }

    public function getProductValues()
    {
        return $this->hasManyThrough(AttributeValue::class, ProductAttribute::class, 'attribute_id', 'id', 'id', 'attribute_value_id');
    }


    
}
