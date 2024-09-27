<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class AdminProductApiController extends Controller
{
    public function index()
    {
        return Product::paginate(10);
    }

    public function show($id)
    {
        return Product::findOrFail($id);
    }

    public function create(Request $request)
    {
        $Validator = Validator::make($request->all() , [
            'Name' => 'required | unique:products,Name',
            'Price' => 'required',
            'category_id' => 'required',
            'restaurant_id' => 'required',
            'Description' => 'required'
        ] , ['required' => 'please enter information for product ! (empty)']);

        if ($Validator->errors()->any())
        {
            return $Validator->errors();
        }

        return Product::create($request->all());
    }

    public function update($id , Request $request)
    {
        $products = Product::findOrFail($id);

        if ($products->Name == $request->input('Name'))
        {
            $Validator = Validator::make($request->all() , [
                'Name' => 'required | unique:products,Name',
            ] , ['required' => 'please enter information for restaurant ! (empty)']);
    
            if ($Validator->errors()->any())
            {
                return $Validator->errors();
            }
        }

        return $products->update($request->all());
    }

    public function delete($id)
    {
        return Product::findOrFail($id)->delete();
    }
}
