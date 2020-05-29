<?php

use Faker\Generator as Faker;
use App\User;
use App\Dealer;

$factory->define(App\Order::class, function (Faker $faker) {
	$user = User::inRandomOrder()->get()->first();
    $dealer = Dealer::inRandomOrder()->get()->first();

    return [
         'user_id' => $user->id,
         'dealer_id' => $dealer->id
    ];
});