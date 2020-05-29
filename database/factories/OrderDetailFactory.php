<?php

use Faker\Generator as Faker;
use App\Item;
use App\Order;

$factory->define(App\OrderDetail::class, function (Faker $faker) {
	 $order = Order::inRandomOrder()->get()->first();
     $item = Item::inRandomOrder()->get()->first();

    return [
        'order_id' => $order->id,
        'item_id' => $item->id,
        'quantity' => rand(1, 20)
    ];
});
