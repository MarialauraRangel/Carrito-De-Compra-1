<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    public function stores() {
		return $this->belongsTo(Store::class, 'store_id');
	}

	public function customer() {
		return $this->belongsTo(User::class, 'user_id');
	}

	public function saleUser() {
        return $this->hasMany(UserSale::class, 'user_sale_id');
    }
}
