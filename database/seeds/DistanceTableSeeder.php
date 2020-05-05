<?php

use Illuminate\Database\Seeder;

class DistanceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $distance = [
    		['id' => 1, 'km' => 'Local', 'price' => 'Gratis', 'slug' => 'local-gratis'],
    		['id' => 2, 'km' => '3', 'price' => '10', 'slug' => '3-10'],
    		['id' => 3, 'km' => '5', 'price' => '15', 'slug' => '5-15']
    	];
    	DB::table('distances')->insert($distance);
    }
}
