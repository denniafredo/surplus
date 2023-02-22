<?php

namespace App\Models;

use GuzzleHttp\ClientTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $table = 'categories';
    protected $fillable = ['name','enable'];
    public function products() {
        return $this->belongsToMany(Product::class,'category_products','category_id','product_id');
    }
}
