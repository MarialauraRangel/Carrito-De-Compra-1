<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
    		['id' => 1, 'name' => 'Pizza Napolitana', 'slug' => 'pizza-napolitana', 'price' => 12.5, 'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'category_id' => 1],
    		['id' => 2, 'name' => 'Pizza de Queso', 'slug' => 'pizza-de-queso', 'price' => 12.5, 'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'category_id' => 1],
    		['id' => 3, 'name' => 'Pizza de Jamón', 'slug' => 'pizza-de-jamon', 'price' => 12.5, 'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'category_id' => 1],
    		['id' => 4, 'name' => 'Pizza de Piña', 'slug' => 'pizza-de-pina', 'price' => 12.5, 'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'category_id' => 1],
    		['id' => 5, 'name' => 'Pizza de Mariscos', 'slug' => 'pizza-de-mariscos', 'price' => 12.5, 'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'category_id' => 1],
    		['id' => 6, 'name' => 'Pizza Especial', 'slug' => 'pizza-especial', 'price' => 12.5, 'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'category_id' => 1],
    		['id' => 7, 'name' => 'Pizza Vegetariana', 'slug' => 'pizza-vegetariana', 'price' => 12.5, 'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'category_id' => 1],
    		['id' => 8, 'name' => 'Pizza de Carne', 'slug' => 'pizza-de-carne', 'price' => 12.5, 'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'category_id' => 1]
    	];
    	DB::table('products')->insert($products);
    }
}
