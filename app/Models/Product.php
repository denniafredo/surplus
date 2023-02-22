<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = ['name','description','enable'];
    public function categories() {
        return $this->belongsToMany(Category::class,'category_products','product_id','category_id');
    }
    public function images() {
        return $this->belongsToMany(Image::class,'product_images','product_id','image_id');
    }
}
