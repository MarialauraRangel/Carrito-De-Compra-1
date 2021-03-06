<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSizes extends Model
{
    protected $table = 'product_size';

    protected $fillable = ['product_id', 'size_id', 'price'];
}
