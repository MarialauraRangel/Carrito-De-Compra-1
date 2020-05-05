<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Distance extends Model
{
	protected $table = "distances";

	protected $fillable = [
		'slug',
		'km',
		'price',
		'casher_id',
		'distance_id', 
		'delivery_man_id',
		'state',
		'time',
		'address'
	];

	public function sale() {
		return $this->hasOne(Sale::class, 'id');
	}
}
