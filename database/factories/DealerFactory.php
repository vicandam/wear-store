<?php
use Faker\Generator as Faker;
use App\User;

$factory->define(App\Dealer::class, function (Faker $faker) {
    $dealer = User::inRandomOrder()->get()->first();

    return [
        'user_id' => $dealer->id,
        'group' => '',
        'recruiter' => '',
        'contact_number' => '+63906926298' . rand(0,9),
        'address' => $faker->address,
        'credit_limit' => 2000,
        'credit_balanced' => 2000
    ];
});
