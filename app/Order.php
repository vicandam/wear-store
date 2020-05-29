<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';


    public function order_details()
    {
    	return $this->hasMany(OrderDetail::class);
    }

    public function payment_details()
    {
    	return $this->hasMany(PaymentDetails::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function dealer()
    {
        return $this->belongsTo(Dealer::class)->with('user');
    }

    public function scopeSearch($query, $keyword)
    {
        return $query->whereHas('dealer.user', function($dealer) use ($keyword) {
            $dealer->where('name', 'like', '%' .$keyword. '%');
        });
    }
}
