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
	];

	public function sales() {
		return $this->hasMany(Sale::class);
	}
}
