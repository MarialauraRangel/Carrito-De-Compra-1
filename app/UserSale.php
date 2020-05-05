<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserSale extends Model
{
    protected $table = 'users_sales';

    protected $fillable = ['casher_id', 'delivery_man_id'];


    public function sale() {
		return $this->belongsTo(Sale::class, 'id');
	}

	public function casher() {
		return $this->belongsTo(User::class, 'casher_id');
	}




}
