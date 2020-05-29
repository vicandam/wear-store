<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    public function item_attributes()
    {
    	return $this->hasMany(ItemAttribute::class);
    }

    public function values()
    {
    	return $this->hasMany(AttributeValues::class);
    }
}
