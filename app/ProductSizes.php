<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductSizes extends Model
{
    protected $table = 'product_size';

    protected $fillable = ['product_id', 'size_id', 'price'];

    // public function products(){
    //     return $this->belongsToMany(Product::class, 'product_id');
    // }

    // public function siice(){
    //     return $this->belongsToMany(Size::class, 'size_id');
    // }
}
