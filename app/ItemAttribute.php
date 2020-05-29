<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemAttribute extends Model
{
    public function item()
    {
    	return $this->belongsTo(Item::class);
    }

    public function attribute()
    {
    	return $this->belongsTo(Attribute::class);
    }
}
