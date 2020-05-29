<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderedItemAttributes extends Model
{
    
    public function order_detail()
    {
    	return $this->belongsTo(OrderDetail::class);
    }

    public function attribute()
    {
    	return $this->belongsTo(Attribute::class);
    }

    public function attribute_value()
    {
    	return $this->belongsTo(AttributeValues::class);
    }
}
