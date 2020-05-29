<?php

use Illuminate\Database\Seeder;

class AttributeValueTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\AttributeValues::class, 9)->create();
    }
}
