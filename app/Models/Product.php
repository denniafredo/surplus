<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = ['name','description','enable'];
    public function categoryProducts() {
        return $this->hasMany('App\Models\CategoryProduct');
    }
    public function productImages() {
        return $this->hasMany('App\Models\ProductImage');
    }
}
