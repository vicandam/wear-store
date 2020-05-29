<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DateTime;

class OrderDetail extends Model
{
    protected $table = 'order_details';

    public function getDate()
    {
        return array('created_at');
    }

    function order()
    {
    	return $this->belongsTo(Order::class);
    }

    public function item()
    {
    	return $this->belongsTo(Item::class)->with('category');
    }

    public function item_attributes()
    {
        return $this->hasMany(OrderedItemAttributes::class);
    }

    public function scopeSearch($query, $keyword, $date, $range)
    {
        if ($range == 'weekly' ) {
            $dt = explode('-', $date);

            $year = (int) $dt[0];
            $week = (int) filter_var($dt[1], FILTER_SANITIZE_NUMBER_INT);

            $date = \Carbon\Carbon::now();
            $date->setISODate($year, $week);

            $startOfWeek = $date->startOfWeek()->format('Y-m-d');
            $endOfWeek = $date->endOfWeek()->format('Y-m-d');
        }

        // Search for date range excluding weekly with keyword
        if ($keyword != null && $date != null) {
            if ($range != 'weekly') {
                return $query->whereHas('item.category', function($items) use($keyword) {
                    $items->where('items.name', 'like', '%' .$keyword. '%');
                })->where('created_at', 'like', '%' .$date. '%');
            }
        }
        
        // Search only for keyword
        else if ($keyword != null) {
            
            return $query
                    ->whereHas('item.category', function($items) use($keyword) {
                        $items->where('categories.name', 'like', '%' .$keyword. '%')
                            ->orWhere('items.name', 'like', '%' .$keyword. '%');
                    })
                    ->orWhereHas('order.dealer.user', function($dealer) use($keyword) {
                        $dealer->where('users.name', 'like', '%' .$keyword. '%');                            
                    })
                    ->orWhereHas('order.dealer', function($users) use($keyword) {
                        $users->where('dealers.recruiter', 'like', '%' .$keyword. '%');                            
                    });
        }

        // Search for keyword with date range excluding weekly
        else if($keyword != null && $range != 'weekly'){
            return $query->whereHas('item.category', function($items) use($keyword) {
                $items->where('items.name', 'like', '%' .$keyword. '%');
            })->orWhere('created_at', 'like', '%' .$date. '%');
        }

        // Date range selected either daily or monthly excluding weekly
        else if ($date != null && $range != 'weekly') {
            return $query->where('created_at', 'like', '%' .$date. '%');
        }

        // Date range selected is weekly
        else if ($date != null && $range == 'weekly') {            
            return $query->where('created_at', '>=', $startOfWeek)->where('created_at', '<=', $endOfWeek.' 23:59:59');
        }
    }
}
