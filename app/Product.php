<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [ 'image', 'name', 'slug', 'description', 'category_id'];

    public function category() {
		return $this->belongsTo(Category::class);
	}

	public function sizes() {
		return $this->belongsToMany(Size::class)->withPivot('price')->withTimestamps();
	}

	public function stores() {
		return $this->belongsToMany(Store::class)->withTimestamps();
	}

	public function order(){
        return $this->belongsTo(Store::class, 'order_id');
    }

    public function products(){
    	return $this->hasOne(ProductSizes::class, 'id');
    }
}
