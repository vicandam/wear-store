<?php

use Illuminate\Database\Seeder;

class ItemAttributesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\ItemAttribute::class, 90)->create();
    }
}
