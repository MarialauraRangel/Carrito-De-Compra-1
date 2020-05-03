<?php

use Illuminate\Database\Seeder;

class SizesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sizes = [
    		['id' => 1, 'name' => 'Pequeña', 'slug' => 'pequena', 'price' => 48.0],
    		['id' => 2, 'name' => 'Madiana', 'slug' => 'mediana', 'price' => 65.0],
    		['id' => 3, 'name' => 'Grande', 'slug' => 'grande', 'price' => 75.0],
    		['id' => 4, 'name' => 'Familiar', 'slug' => 'familiar', 'price' => 94.0],
            ['id' => 5, 'name' => 'Super', 'slug' => 'super', 'price' => 104.0],
            ['id' => 6, 'name' => 'Gigante', 'slug' => 'gigante', 'price' => 209.0],
            ['id' => 7, 'name' => 'Super Gigante', 'slug' => 'super-gigante', 'price' => 245.0],
    		['id' => 8, 'name' => 'Normal', 'slug' => 'normal', 'price' => NULL]
    	];
    	DB::table('sizes')->insert($sizes);
    }
}
