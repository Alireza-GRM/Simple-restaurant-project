<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['Name' , 'Price' , 'category_id' , 'restaurant_id' , 'Description'];

    // زمانی که میخوایم نشون بدیم این غذا برای کدوم دسته بندیه  n->1
    public function category()
    {
        return $this->belongsTo(Category::class)->first();
    }

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class)->first();
    }
}
