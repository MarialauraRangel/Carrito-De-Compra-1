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
		'casher_id',
		'distance_id', 
		'delivery_man_id',
		'state',
		'time',
		'address'
	];

	public function store() {
		return $this->belongsTo(Store::class);
	}

	public function customer() {
		return $this->belongsTo(User::class);
	}

	public function casher() {
		return $this->belongsTo(User::class, 'casher_id', 'id');
	}

	public function delivery() {
		return $this->belongsTo(User::class, 'delivery_man_id', 'id');
	}

	public function distance() {
		return $this->belongsTo(Distance::class);
	}

	public function orders() {
		return $this->hasMany(Order::class);
	}
}