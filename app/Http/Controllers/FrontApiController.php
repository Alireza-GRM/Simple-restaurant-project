<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Http\Request;

class FrontApiController extends Controller
{
    public function searchRestaurant($q)
    {
        return Restaurant::where('Title' , 'like' , '%'.$q.'%')->paginate(10);
    }

    public function index()
    {
        $restaurant = Restaurant::orderByDesc('created_at')->limit(5)->get();
        $BestRestaurant = Restaurant::orderByDesc('Counter')->limit(5)->get();
        $category = Category::all();
        $userCount = User::all()->count();
        $restaurantSlide = Restaurant::where('Is_Slide' , '=' , 1)->orderByDesc('updated_at')->get();

        $respons = [
            'restaurant' => $restaurant , 
            'BestRestaurant' => $BestRestaurant , 
            'userCount' => $userCount ,
            'restaurantSlide' => $restaurantSlide ,
            'category' => $category
        ];

        return response($respons , 200);
    }

    public function restaurant($id , Request $request)
    {
        $restaurant = Restaurant::findOrFail($id);
        $category = Category::all();

        if ($request->get('category'))
        {
            $product = Product::where('restaurant_id' , '=' , $restaurant->id)->where('category_id' , '=' , $request->get('category'))->get();
        }
        else
        {
            $product = Product::where('restaurant_id' , '=' , $restaurant->id)->get();
        }

        $restaurant->update([
            'Counter' => $restaurant->Counter + 1
        ]);

        $respons = [
            'restaurant' => $restaurant, 
            'product' => $product,
            'category' => $category
        ];

        return response($respons , 200);
    }
}
