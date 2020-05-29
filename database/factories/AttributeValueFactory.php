<?php

use Faker\Generator as Faker;
use App\Attribute;

$factory->define(App\AttributeValues::class, function (Faker $faker) {
	
	$attribute = Attribute::inRandomOrder()->get()->first();

    return [
        'attribute_value' => $faker->name,
        'attribute_id' => $attribute->id
    ];
});
