<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sizes extends Model
{
    protected $fillable = ['name', 'slug'];

    public function products() {
		return $this->belongsToMany(Product::class)->withPivot('price')->withTimestamps();
	}
}
