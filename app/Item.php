<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['user_id', 'category_id', 'name', 'price', 'dealer_discount', 'store_profit', 'net_amount', 'photo'];

    function category()
    {
    	return $this->belongsTo(Category::class);
    }

    function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function GetItemName($query, $id)
    {
    	return $query->whereId($id)->first()->name;
    }

    public function orders()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function item_attributes()
    {
        return $this->hasMany(ItemAttribute::class);
    }    

    public function scopeSearch($query, $keyword)
    {
        return $query->whereHas('category', function($category) use ($keyword) {
            $category->where('categories.name', 'like', '%' .$keyword. '%')
            ->orWhere('items.name', 'like', '%' .$keyword. '%');           
        });
    }
}
