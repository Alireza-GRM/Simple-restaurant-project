<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class AdminCategoryApiController extends Controller
{
    public function index()
    {
        return Category::paginate(10);
    }

    public function show($id)
    {
        return Category::findOrFail($id);
    }

    public function create(Request $request)
    {
        $Validator = Validator::make($request->all() , [
            'Name' => 'required',
            'description' => 'required | max:600'
        ] , ['required' => 'please enter name for category ! (empty)']);

        if ($Validator->errors()->any())
        {
            return $Validator->errors();
        }

        return Category::create($request->all());
    }

    public function update($id , Request $request)
    {
        $Category = Category::findOrFail($id);

        return $Category->update($request->all());
    }

    public function delete($id)
    {
        return Category::findOrFail($id)->delete();
    }
}
