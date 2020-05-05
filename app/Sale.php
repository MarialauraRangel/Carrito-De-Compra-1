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

	public function stores() {
		return $this->belongsTo(Store::class, 'store_id');
	}

	public function customer() {
		return $this->belongsTo(User::class, 'user_id');
	}

	public function casher() {
		return $this->belongsTo(User::class, 'casher_id');
	}

	public function delivery() {
		return $this->belongsTo(User::class, 'delivery_man_id');
	}

	public function distance() {
		return $this->belongsTo(Distance::class, 'distance_id');
	}

	
	
}
