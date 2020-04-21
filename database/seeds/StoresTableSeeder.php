<?php

use Illuminate\Database\Seeder;

class StoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stores = [
    		['id' => 1, 'name' => 'Pizzería 1', 'slug' => 'pizzeria-1'],
    		['id' => 2, 'name' => 'Pizzería 2', 'slug' => 'pizzeria-2']
    	];
    	DB::table('stores')->insert($stores);
    }
}
