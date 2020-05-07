<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{

	protected $table = "sales";

	protected $fillable = [
		'slug',
		'user_id',
		'store_id',
		'distance_id',
		'state',
		'time',
		'total',
		'address'
	];

	public function store() {
		return $this->belongsTo(Store::class);
	}

	public function users() {
		return $this->belongsToMany(User::class)->withPivot('rol')->withTimestamps();
	}

	public function distance() {
		return $this->belongsTo(Distance::class);
	}

	public function orders() {
		return $this->hasMany(Order::class);
	}
}