<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "orders";

	protected $fillable = [
		'sale_id',
		'product_id',
		'size_id',
		'store_id', 
		'price',
		'qty'
	];

	public function product() {
        return $this->hasOne(Product::class, 'id');
    }

    public function size() {
        return $this->hasOne(Size::class, 'id');
    }
}
