<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
	protected $fillable = [ 'image', 'name', 'slug', 'address', 'phone-one', 'phone-two', 'state'];

    public function products() {
		return $this->belongsToMany(Product::class)->withTimestamps();
	}

	public function users() {
        return $this->hasMany(User::class);
    }

    public function sales() {
        return $this->hasOne(Store::class, 'id');
    }


}
