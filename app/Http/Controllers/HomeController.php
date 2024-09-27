<?php

namespace App\Http\Controllers;

//use Illuminate\Support\Facades\DB;برای کوئری بیلدر
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;

class HomeController extends Controller
{
    public function home()
    {
        // $restaurant = Restaurant::where('Title' , 'like' , '%e%')->get();
        // $restaurant = Restaurant::paginate(5);
        $restaurant = Restaurant::orderByDesc('created_at')->limit(5)->get();
        $BestRestaurant = Restaurant::orderByDesc('Counter')->limit(5)->get();
        $category = Category::all();
        $userCount = User::all()->count();
        $restaurantSlide = Restaurant::where('Is_Slide' , '=' , 1)->orderByDesc('updated_at')->get();

        return view('front.index' , [
            'restaurant' => $restaurant , 
            'BestRestaurant' => $BestRestaurant , 
            'userCount' => $userCount ,
            'restaurantSlide' => $restaurantSlide ,
            'category' => $category
        ]);
    }

    public function restaurantAll()
    {
        $restaurant = Restaurant::all();
        return view('front.restaurantAll' , ['restaurant' => $restaurant]);
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

        $restaurant
        ->update([
            'Counter' => $restaurant->Counter + 1
        ]);

        return view('front.restaurant' , [
            'restaurant' => $restaurant , 
            'product' => $product,
            'category' => $category
        ]);
    }

    public function search(Request $request)
    {
        $q = $request->get('search');
        $restaurant = Restaurant::where('Title' , 'like' , '%'.$q.'%')->get();

        return view('front.search' , ['rest' => $restaurant]);
    }

    public function category($id)
    {
        $category = Category::find($id);
        return view('front.category' , [
            'category' => $category
        ]);
    }

    // public function home()
    // {
        // 1)
        // $restaurant = db::table('shop')->get();
        // dd($restaurant);

        // 2)
        // $id = 2;
        // $restaurant = db::table('shop')->where('id','=',$id)->get();
        // dd($restaurant);

        // 3)
        // $restaurant = db::table('shop')
        // ->insert([
        //     'name' => 'محمود',
        //     'family' => 'گرمخورانی',
        //     'image' => '07'
        // ]);
        // dd($restaurant);
        
        // 4)
        // $restaurant = db::table('shop')
        // ->where('id','=',3)
        // ->update([
        //     'family' => 'بداق بیگی'
        // ]);
        // dd($restaurant);

        // 5)
        // $restaurant = db::table('shop')
        // ->where('id','=',1)
        // ->delete();
        // dd($restaurant);

        // 6)
        // $restaurant = db::table('shop')
        // ->select(['id' , 'title' , 'description'])
        // ->get();
        // dd($restaurant);

        // 7)
        // $restaurant = db::table('shop')
        // ->select(['shop.title as نام رستوران' , 'product.name as نام کالا' , 'product.price as قیمت'])
        // ->leftJoin('product' , 'shop.id' , 'restaurant_id')
        // ->get();
        // dd($restaurant);
    // }

    // public function admin()
    // {
    //     // dd(request()->is('admin'));
    //     // $name = 'Salam Alireza';
    //     // $persons = ['ali' , 'reza' , 'mahdi'];
    //     // return view('home.home')->with('NameFamily' , $name);
    //     // return view('home.home' , ['NameFamily' => $name , 'Persons' => $persons]);
    // }

    // public function hello()
    // {
    //     return 'Hello World.';
    // }

    // public function hello($name)
    // {
    //     return 'Hello MR.'.$name;
    // }

    // public function plus($num1 , $num2)
    // {
    //     return 'Sum : '.$num1 + $num2;
    // }
}
