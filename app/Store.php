<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
	protected $fillable = [ 'image', 'name', 'slug', 'address', 'phone-one', 'phone-two', 'state'];

    public function products() {
		return $this->belongsToMany(Product::class)->withTimestamps();
	}
}
