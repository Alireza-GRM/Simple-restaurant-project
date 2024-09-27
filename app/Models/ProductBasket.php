<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductBasket extends Model
{
    use HasFactory;

    protected $fillable = ['product_id' , 'basket_id' , 'Counte' , 'restaurant_id' , 'user_id' , 'Status_Paying'];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class)->first();
    }

    public function product()
    {
        return $this->belongsTo(product::class)->first();
    }
}
