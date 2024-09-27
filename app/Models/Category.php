<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['Name' , 'description'];

    // 1->n زمانی که میخوایم نشون بدیم که هر دسته بندی چندتا غذا داره
    public function product()
    {
        return $this->hasMany(Product::class)->get();
    }
}
