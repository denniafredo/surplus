<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = 'product_images';

    public function products() {
        return $this->belongsTo('App\Models\Product');
    }
    public function images() {
        return $this->belongsTo('App\Models\Images');
    }
}
