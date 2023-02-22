<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';
    protected $fillable = ['name','file','enable'];
    public function productImages() {
        return $this->hasMany('App\Models\ProductImage');
    }
}
