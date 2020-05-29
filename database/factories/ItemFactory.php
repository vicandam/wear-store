<?php

use App\Category;
use App\User;
use Faker\Generator as Faker;

$factory->define(App\Item::class, function (Faker $faker) {
    $user = User::inRandomOrder()->get()->first();
    $category = Category::inRandomOrder()->get()->first();
    $price = rand(100,2000);

    return [
        //
        'user_id' => $user->id,
        'category_id' => $category->id,
        'name' => $faker->company,
        'quantity' => rand(1,20),
        'price' => $price,
        'dealer_discount' => $category->discount,
        'store_profit' => (18/100) * $price,
        'net_amount' => $price - $category->discount,
        'photo' => $faker->image('public/storage/avatars',400,300,null, false),
    ];
});
