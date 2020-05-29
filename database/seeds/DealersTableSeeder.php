<?php

use Illuminate\Database\Seeder;

class DealersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 10)->create()->each(function($dealer) {
            factory(App\Dealer::class)->create([
                'user_id' => $dealer->id
            ]);
        });


    }
}
