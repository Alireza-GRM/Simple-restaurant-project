<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class AdminRestaurantApiController extends Controller
{
    public function index()
    {
        return Restaurant::paginate(10);
    }

    public function show($id)
    {
        return Restaurant::findOrFail($id);
    }

    public function create(Request $request)
    {
        $Validator = Validator::make($request->all() , [
            'Title' => 'required | unique:restaurants,Title',
            'Address' => 'required | max:100',
            'image' => 'required | mimes:png,jpg'
        ] , ['required' => 'please enter information for restaurant ! (empty)']);

        if ($Validator->errors()->any())
        {
            return $Validator->errors();
        }

        $name = $request->input('Title');
        $address = $request->input('Address');
        $image = time() .'-'. $request->file('image')->getClientOriginalName();
        $request->file('image')->move(public_path('image') , $image);
        $Is_Slide = $request->input('Is_Slide');
        $description = $request->input('Description');

        return Restaurant::create([
            'Title' => $name,
            'Address' => $address,
            'image' => $image,
            'Is_Slide' => $Is_Slide ?? 0,
            'Description' => $description
        ]);
    }

    public function update($id , Request $request)
    {
        $restaurant = Restaurant::findOrFail($id);

        if ($restaurant->Title == $request->input('Title'))
        {
            $Validator = Validator::make($request->all() , [
                'Title' => 'required | unique:restaurants,Title'
            ] , ['required' => 'please enter information for restaurant ! (empty)']);
    
            if ($Validator->errors()->any())
            {
                return $Validator->errors();
            }
        }

        return $restaurant->update($request->all());
    }

    public function delete($id)
    {
        return Restaurant::findOrFail($id)->delete();
    }
}
