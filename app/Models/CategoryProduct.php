<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{
    protected $table = 'category_products';
    protected $fillable = ['product_id','category_id'];

    public function products() {
        return $this->belongsTo('App\Models\Product');
    }
    public function categories() {
        return $this->belongsTo('App\Models\Category');
    }
}
