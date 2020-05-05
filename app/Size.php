<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $fillable = ['name', 'slug'];

    public function products() {
		return $this->belongsToMany(Product::class)->withPivot('price')->withTimestamps();
	}

	public function sais(){
		return $this->hasMany(ProductSizes::class, 'id');
	}
}
