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
        $categories = [
    		['id' => 1, 'name' => 'Pizza', 'slug' => 'pizza'],
    		['id' => 2, 'name' => 'Bebidas', 'slug' => 'bebidas']
    	];
    	DB::table('categories')->insert($categories);
    }
}