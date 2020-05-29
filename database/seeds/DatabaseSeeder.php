<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UsersTableSeeder::class);
         $this->call(DealersTableSeeder::class);
         $this->call(CategoriesTableSeeder::class);
         $this->call(ItemsTableSeeder::class);
         $this->call(OrdersTableSeeder::class);
         $this->call(AttributesTableSeeder::class);
         $this->call(AttributeValueTableSeeder::class);
         $this->call(ItemAttributesTableSeeder::class);
    }
}
