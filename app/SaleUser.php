<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaleUser extends Model
{
    protected $table = 'sale_user';

    protected $fillable = ['sale_id', 'user_id', 'rol'];
}
