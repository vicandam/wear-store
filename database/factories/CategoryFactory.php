<?php

use Faker\Generator as Faker;
use App\User;

$factory->define(App\Category::class, function (Faker $faker) {

	return [
		'name' => $faker->company,
		'discount' => rand(1,100),
		'photo' => $faker->image('public/storage/avatars',400,300,null, false)
	];

});
