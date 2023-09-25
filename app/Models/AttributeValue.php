<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttributeValue extends Model
{
    use HasFactory;

    protected $tables = 'attribute_values';
    protected $guarded = false;

    public function Attribute()
    {
        return $this->belongsTo(Attribute::class, 'attribute_id', 'id');
    }
    public function getValueNameById($attribute_value_id)
    {
        $attributeValue = $this->find($attribute_value_id);

        if ($attributeValue) {
            return $attributeValue->name;
        }
    }
    
}
