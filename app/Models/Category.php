<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = ['name','enable'];
    public function categoryProducts() {
        return $this->hasMany('App\Models\CategoryProduct');
    }
}
