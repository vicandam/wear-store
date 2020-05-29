<?php

use Faker\Generator as Faker;
use App\Category;


$factory->define(App\CategoryDiscount::class, function (Faker $faker) {
    $category = Category::inRandomOrder()->get()->first();

    return [
        //
        'category_id' => $category->id,
        'amount' => rand(1, 100)
    ];
});