<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(\App\Category::class, 6)->create()->each(function($category){
            // Create category discount
            factory(\App\CategoryDiscount::class)->create([
                'category_id' => $category->id
            ]);

            // Create store profits
            factory(\App\StoreProfit::class)->create([
                'category_id' => $category->id
            ]);
        });
    }
}
