<?php

use Faker\Generator as Faker;
use App\Item;
use App\Attribute;
use App\AttributeValues;

$factory->define(App\ItemAttribute::class, function (Faker $faker) {
	
	$items = Item::inRandomOrder()->get()->first();	
	$attribute = Attribute::inRandomOrder()->get()->first();
	$attribute_value = AttributeValues::inRandomOrder()->get()->first();

    return [
        'item_id' => $items->id,
        'attribute_id' => $attribute->id
    ];
});
