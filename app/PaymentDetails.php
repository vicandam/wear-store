<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PaymentDetails extends Model
{
    protected $table = 'payment_details';

    public function orders()
    {
    	return $this->belongsTo(Order::class);
    }
}
