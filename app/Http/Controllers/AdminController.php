<?php

namespace App\Http\Controllers;

use App\Http\Requests\RestaurantRequest;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Models\Product;
use App\Models\Category;

class AdminController extends Controller
{
    public function admin()
    {
        return view("admin.panel");
    }

    //

    public function categoryList()
    {
        $categories = Category::all();
        return view('admin.category-list' , ['categories' =>  $categories]);
    }

    public function categoryCreate()
    {
        return view('admin.category-create');
    }

    public function categoryInsert(Request $request)
    {
        $request->validate([
            'nameCategory' => 'required | unique:categories,Name',
            'description' => 'required'
        ]);

        $name = $request->input('nameCategory');
        $description = $request->input('description');

        //  3)
        //  protected for create
        Category::create([
            'Name' => $name,
            'description' => $description
        ]);

        return redirect(route('category-list'));
    }

    public function categoryEdit($id)
    {
        $category = Category::find($id);
        return view('admin.category-edit' , ['category' => $category]);
    }

    public function categoryUpdate(Request $request)
    {
        $request->validate([
            'nameCategory' => 'required | unique:categories,Name',
            'description' => 'required'
        ]);
        
        Category::findOrFail($request->input('id'))
        ->update([
            'Name' => $request->input('nameCategory'),
            'description' => $request->input('description'),
        ]);

        return redirect(route('category-list'));
    }

    public function categoryDelete($id)
    {
        Category::findOrFail($id)->delete();

        return redirect(route('category-list'));
    }

    //

    public function productList()
    {
        $products = Product::all();
        return view('admin.product-list' , ['products' => $products ]);
    }

    public function productCreate()
    {
        $restaurant = Restaurant::all();
        $category = Category::all();

        return view('admin.product-create' , ['restaurant' => $restaurant , 'category' => $category]);
    }

    public function productInsert(Request $request)
    {
        $request->validate([
            'nameFood' => 'required',
            'price' => 'required',
            'category' => 'required',
            'restorun' => 'required',
            'description' => 'required'
        ]);

        //  3)
        //  protected for create
        Product::create([
            'Name' => $request->input('nameFood'),
            'Price' => $request->input('price'),
            'restaurant_id' => $request->input('restorun'),
            'category_id' => $request->input('category'),
            'Description' => $request->input('description')
        ]);

        return redirect(route('product-list'));
    }

    public function productEdit($id)
    {
        $product = Product::findOrFail($id);
        $restaurant = Restaurant::all();
        $category = Category::all();

        return view('admin.product-edit' , ['product' => $product , 'restaurant' => $restaurant , 'category' => $category]);
    }

    public function productUpdate(Request $request)
    {
        $request->validate([
            'nameFood' => 'required',
            'price' => 'required',
            'category' => 'required',
            'restorun' => 'required',
            'description' => 'required'
        ]);

        Product::findOrFail($request->input('id'))
        ->update([
            'Name' => $request->input('nameFood'),
            'Price' => $request->input('price'),
            'restaurant_id' => $request->input('restorun'),
            'category_id' => $request->input('category'),
            'Description' => $request->input('description')
        ]);

        return redirect(route('product-list'));
    }

    public function productDelete($id)
    {
        Product::findOrFail($id)->delete();

        return redirect(route('product-list'));
    }

    //

    public function restaurantList()
    {
        return view('admin.restaurant-list' , ['restaurants' => Restaurant::all() ]);
    }

    public function restaurantCreate()
    {
        return view('admin.restaurant-create');
    }

    public function restaurantInsert(Request $request)
    {
        // 'name' => 'required | integer | max:10 | min:3'
        $request->validate([
            'name' => 'required | unique:restaurants,Title',
            'address' => 'required | max:100',
            'image' => 'required | mimes:png,jpg'
        ]);

        $name = $request->input('name');
        $address = $request->input('address');
        $image = time() .'-'. $request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('image') , $image);
        $Is_Slide = $request->input('check');
        $description = $request->input('description');


        // 1)
        // $Restaurant = new Restaurant();
        // $Restaurant->Title = $name;
        // $Restaurant->Address = $address;
        // $Restaurant->image = $image;
        // $Restaurant->save();

        // 2)
        // Restaurant::insert([
        //     'Title' => $name,
        //     'Address' => $address,
        //     'image' => $image
        // ]);

        //  3)
        //  protected for create
        Restaurant::create([
            'Title' => $name,
            'Address' => $address,
            'image' => $image,
            'Is_Slide' => $Is_Slide ?? 0,
            'Description' => $description
        ]);


        // return redirect('/admin/restaurant/list');
        return redirect(route('restaurant-list'));
    }

    public function restaurantEdit($id)
    {
        $restaurant = Restaurant::find($id);
        return view('admin.restaurant-edit' , ['restaurant' => $restaurant]);
    }

    public function restaurantUpdate(Request $request)
    {
        $restaurants = Restaurant::findOrFail($request->input('id'));

        if ($restaurants->Title == $request->input('name'))
        {
            $request->validate([
                'name' => 'required',
                'address' => 'required | max:100',
                'image' => 'mimes:png,jpg'
            ]);
        }
        else
        {
            $request->validate([
                'name' => 'required | unique:restaurants,Title',
                'address' => 'required | max:100',
                'image' => 'mimes:png,jpg'
            ]);
        }

        $image = false;
        if ($request->file('image'))
        {
            $image = time() .'-'. $request->file('image')->getClientOriginalName();
            $request->file('image')->move(public_path('image') , $image);
        }

        if ($image)
        {
            if(file_exists(public_path('image/'.$restaurants->image)))
            {
                unlink(public_path('image/'.$restaurants->image));
            }

            $restaurants
            ->update([
                'Title' => $request->input('name'),
                'Address' => $request->input('address'),
                'image' => $image,
                'Is_Slide' => $request->input('check') ?? 0,
                'Description' => $request->input('description')
            ]);
        }
        else
        {
            $restaurants
            ->update([
                'Title' => $request->input('name'),
                'Address' => $request->input('address'),
                'Is_Slide' => $request->input('check') ?? 0,
                'Description' => $request->input('description')
            ]);
        }

        return redirect(route('restaurant-list'));
    }

    public function restaurantDelete($id)
    {
        $Image = Restaurant::findOrFail($id);
        if(file_exists(public_path('image/'.$Image->image)))
        {
            unlink(public_path('image/'.$Image->image));
        }
        
        Restaurant::findOrFail($id)->delete();

        return redirect(route('restaurant-list'));
    }
}
